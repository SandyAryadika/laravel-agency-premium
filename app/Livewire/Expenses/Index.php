<?php

namespace App\Livewire\Expenses;

use App\Models\Expense;
use Livewire\Component;
use Livewire\WithFileUploads; // Wajib untuk upload struk
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    // Form Variables
    public $description, $amount, $category, $date;
    public $receipt; // File upload

    // UI Variables
    public $isModalOpen = false;
    public $search = '';

    // Predefined Categories (Bisa ditambah nanti)
    public $categories = [
        'Server & Infrastructure',
        'Software Subscriptions',
        'Marketing & Ads',
        'Freelancer / Salary',
        'Office Supplies',
        'Travel & Meetings',
        'Other'
    ];

    protected $rules = [
        'description' => 'required|min:3',
        'amount' => 'required|numeric|min:1000',
        'category' => 'required',
        'date' => 'required|date',
        'receipt' => 'nullable|image|max:2048', // Max 2MB
    ];

    public function openModal()
    {
        $this->reset(['description', 'amount', 'category', 'date', 'receipt']);
        $this->date = now()->format('Y-m-d'); // Default hari ini
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function save()
    {
        $this->validate();

        $path = null;
        if ($this->receipt) {
            $path = $this->receipt->store('receipts', 'public');
        }

        Expense::create([
            'user_id' => Auth::id(),
            'description' => $this->description,
            'amount' => $this->amount,
            'category' => $this->category,
            'date' => $this->date,
            'receipt_path' => $path,
        ]);

        $this->closeModal();
        session()->flash('success', 'Expense recorded successfully.');
    }

    public function delete($id)
    {
        $expense = Expense::where('user_id', Auth::id())->find($id);

        if ($expense) {
            if ($expense->receipt_path) {
                Storage::disk('public')->delete($expense->receipt_path);
            }
            $expense->delete();
            session()->flash('success', 'Expense deleted.');
        }
    }

    public function render()
    {
        $expenses = Expense::where('user_id', Auth::id())
            ->when($this->search, function ($q) {
                $q->where('description', 'like', '%' . $this->search . '%')
                    ->orWhere('category', 'like', '%' . $this->search . '%');
            })
            ->latest('date')
            ->paginate(10);

        return view('livewire.expenses.index', [
            'expenses' => $expenses
        ]);
    }
}
