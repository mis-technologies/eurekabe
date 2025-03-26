<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Student\Models\StudentExam;

class StudentExamTable extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'id'; // Default sort field
    public $sortDirection = 'asc'; // Default sort direction
    public $filters = [
        'status' => '',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }


    // public function render()
    // {
    //     $query = StudentExam::query()
    //         ->with(['exam.subject', 'user']); // Eager load related models (exam, subject, and user)

    //     // Apply search filter
    //     if ($this->search) {
    //                     $query->whereHas('user', function ($q) {
    //             $q->where('firstname', 'like', '%' . $this->search . '%')
    //                 ->orWhere('email', 'like', '%' . $this->search . '%');
    //         })->orWhereHas('exam', function ($q) {
    //             $q->where('title', 'like', '%' . $this->search . '%')
    //                 ->orWhereHas('subject', function ($subQuery) {
    //                     $subQuery->where('name', 'like', '%' . $this->search . '%');
    //                 });
    //         });
    //     }

    //     // Apply status filter
    //     if ($this->filters['status']) {
    //         $query->where('status', $this->filters['status']);
    //     }

    //     // Apply sorting
    //     $query->orderBy($this->sortField, $this->sortDirection);

    //     $data = $query->paginate(10);

    //     // Append result data to each StudentExam instance
    //     $data->getCollection()->transform(function ($studentExam) {
    //         $studentExam->result = $studentExam->result(); // Add result data
    //         return $studentExam;
    //     });

    //     return view('livewire.student-exam-table', [
    //         'studentExams' => $data,
    //     ]);
    // }

    public function render()
{
    $query = StudentExam::query()
        ->with(['exam.subject', 'user']); // Eager load related models (exam, subject, and user)

    // Apply search filter
    if ($this->search) {
        $query->whereHas('user', function ($q) {
            $q->where('firstname', 'like', '%' . $this->search . '%') // Use 'firstname'
              ->orWhere('lastname', 'like', '%' . $this->search . '%') // Use 'lastname'
              ->orWhere('email', 'like', '%' . $this->search . '%');
        })->orWhereHas('exam', function ($q) {
            $q->where('title', 'like', '%' . $this->search . '%')
              ->orWhereHas('subject', function ($subQuery) {
                  $subQuery->where('name', 'like', '%' . $this->search . '%');
              });
        });
    }

    // Apply status filter
    if ($this->filters['status']) {
        $query->where('status', $this->filters['status']);
    }

    // Apply sorting
    $query->orderBy($this->sortField, $this->sortDirection);

    $data = $query->paginate(10);

    // Append result data to each StudentExam instance
    $data->getCollection()->transform(function ($studentExam) {
        $studentExam->result = $studentExam->result(); // Add result data
        return $studentExam;
    });

    return view('livewire.student-exam-table', [
        'studentExams' => $data,
    ]);
}
}
