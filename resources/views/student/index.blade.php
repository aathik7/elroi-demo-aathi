<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="row">
        <div class="block col-md-1 mb-4 flex items-center justify-end">
            <a href="{{ route('student.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
            {{__('Add Student')}} </a>
        </div>
    </div>
        <table>
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            @foreach($studentDetails as $studentDetail)
            <tr>
                <td>{{ $studentDetail['name'] }}</td>
                <td>{{ $studentDetail['active_flag'] ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2" href="/edit/{{$studentDetail['id']}}">Edit</a>
                    <a class="text-red-600 hover:text-red-900 mb-2 mr-2" href="" onclick="deleteStudent('{{$studentDetail['id']}}')"> Delete</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
        <style>
            table, td, th {
                border: 1px solid #ddd;
                text-align: left;
            }
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th, td {
                padding: 15px;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            function deleteStudent(id) {
                if (confirm('Are you want to delete ?')) {
                    $.ajax({
                        type: "POST",
                        url: "/delete",
                        data: '_token=<?php echo csrf_token() ?>&id='+id,
                        success:function(data) {
                            alert('Deleted');
                            window.location.href = "/index";
                        }
                    });
                }
            }
        </script>
</x-app-layout>
