
<div>
    
    <div class="flex justify-between mb-4">
        <input type="text" wire:model.lazy="search" placeholder="Search by Name, Email, Exam Title, or Subject..."
            class="border p-2 rounded" />
       
      <div class="flex">
        <select wire:model.lazy="filters.status" class="border p-2 rounded">
            <option value="">All Statuses</option>
            <option value="started">Started</option>
            <option value="submitted">Submitted</option>
            <option value="awaiting_result">Awaiting Result</option>
            <option value="result_released">Result Released</option>
        </select>

        <select wire:model.lazy="perPage" class="border mx-2 p-2 px-10 rounded">
            <option value="50">50 per page</option>
            <option value="100">100 per page</option>
            <option value="200">200 per page</option>
            <option value="300">300 per page</option>
        </select>

        <button id="download-excel" style="background: black" class=" text-white mx-2  px-4 py-2 rounded">Download Excel</button>
      </div>
        
    </div>


    <table id="student-exam-table" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
                <th wire:click="sortBy('id')" class="cursor-pointer">
                    ID
                    @if ($sortField === 'id')
                        <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                    @endif
                </th>
                <th class="cursor-pointer">
                    Student Name
                    @if ($sortField === 'user.name')
                        <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                    @endif
                </th>
                <th class="cursor-pointer">
                    Email
                    @if ($sortField === 'user.email')
                        <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                    @endif
                </th>
                <th class="cursor-pointer">
                    Exam Title
                    @if ($sortField === 'exam.title')
                        <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                    @endif
                </th>
                <th class="cursor-pointer">
                    Subject
                    @if ($sortField === 'exam.subject')
                        <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                    @endif
                </th>
                <th wire:click="sortBy('status')" class="cursor-pointer">
                    Status
                    @if ($sortField === 'status')
                        <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                    @endif
                </th>
                <th wire:click="sortBy('total_marks_earned')"  class="cursor-pointer">
                    Total Marks Earned
                    @if ($sortField === 'total_marks_earned')
                        <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                    @endif
                </th>
                <th class="cursor-pointer">
                    Pass Exam
                    @if ($sortField === 'passed')
                        <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                    @endif
                </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($studentExams as $studentExam)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-800">
                        {{ $studentExam->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-800">
                        {{ $studentExam->user->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-800">
                        {{ $studentExam->user->email ?? 'N/A' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-800">
                        {{ $studentExam->exam->title ?? 'N/A' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-800">
                        {{ $studentExam->exam->subject->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-800">
                        {{ ucfirst($studentExam->status) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-800">
                        {{ $studentExam->total_marks_earned ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-800">
                        {{ $studentExam->result['passed'] ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-800">
                        <button style="background: black" class="text-white px-2 py-1 rounded">Review</button>
                        {{-- <button class="bg-red-500 text-white px-2 py-1 rounded">Delete</button> --}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No results found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $studentExams->links() }}
    </div>

    <div wire:loading>
        <p>Loading...</p>
    </div>
</div>


@push('scripts')
    <!-- Include xlsx library via CDN -->
    <script src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
    <script>
        document.getElementById('download-excel').addEventListener('click', function () {
            const table = document.getElementById('student-exam-table');
            const workbook = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });
            XLSX.writeFile(workbook, 'StudentExamTable.xlsx');
        });
    </script>
@endpush