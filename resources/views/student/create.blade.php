<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Create') }}
        </h2>
    </x-slot>
        <style>
            input[type=text] {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            input[type=submit] {
                width: 100%;
                background-color: #4caf50;
                columns: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            input[type=submit]:hover {
                background-color: #45a049;
            }
        </style>
    </head>
    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <form action="/store" method="post" enctype="multipart/form-data">
            @csrf
            <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-2 bg-white sm:p-6">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="Enter Name..." required>
            </div>
            <div class="px-4 py-2 bg-white sm:p-6">
            <label for="image">Image</label>
            <input type="file" id="image" name="image" required><br>
            </div>
            <label for="hobbies">Hobbies</label><br>
            <div class="px-4 py-2 bg-white sm:p-6">
            <label for="hobbies">Books</label>
            <input type="checkbox" id="books" name="books" value="0" onclick="updateHobby(this)"><br>
            <label for="hobbies">Games</label>
            <input type="checkbox" id="games" name="games" value="0" onclick="updateHobby(this)"><br>
            <label for="hobbies">Painting</label>
            <input type="checkbox" id="painting" name="painting" value="0" onclick="updateHobby(this)"><br>
            <label for="hobbies">Gardening</label>
            <input type="checkbox" id="gardening" name="gardening" value="0" onclick="updateHobby(this)"><br>
            <label for="hobbies">Learning</label>
            <input type="checkbox" id="learning" name="learning" value="0" onclick="updateHobby(this)"><br>
            </div>
            <a onclick="getAddMoreFields()">Add More</a>

            <div id="qualification" style="display: none;">
                <label>Qualifications</label><br>
                <input type="hidden" id="qualification_details" name="qualification_details" value="0">
                <label for="10">10th</label>
                <div class="px-4 py-2 bg-white sm:p-6">
                <input type="text" id="10_year" name="10_Year" placeholder="Enter Year...">
                <input type="text" id="10_univercity" name="10_univercity" placeholder="Enter Univercity...">
                </div>
                <label for="12">12th</label>
                <div class="px-4 py-2 bg-white sm:p-6">
                <input type="text" id="12_year" name="12_Year" placeholder="Enter Year...">
                <input type="text" id="12_univercity" name="12_univercity" placeholder="Enter Univercity...">
                </div>
                <label for="ug">UG</label>
                <div class="px-4 py-2 bg-white sm:p-6">
                <input type="text" id="ug_year" name="ug_Year" placeholder="Enter Year...">
                <input type="text" id="ug_univercity" name="ug_univercity" placeholder="Enter Univercity..."><br>
                </div>
                <a onclick="hideAddMoreFields()">Add Less</a>
            </div>
            </div>
            <button type="submit" class="inline-flex items-center px-4 py-2 mr-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                {{__('Create')}}
            </button>
            <button type="button" x-data @click="cancel()" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 active:bg-gray-500 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 cancelBtn">
                {{__('Cancel')}}
            </button>
        </form>
    </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            function cancel() {
                window.location.href = "{{route('student.index')}}";
            }
            function getAddMoreFields() {
                document.getElementById('qualification').style.display = "block";
                document.getElementById('qualification_details').value = "1";
                updateRequired(true);
            }
            function hideAddMoreFields() {
                document.getElementById('qualification').style.display = "none";
                document.getElementById('qualification_details').value = "0";
                updateRequired(false);
            }
            function updateHobby(hobby) {
                hobby.value = hobby.value == 1 ? 0 : 1;
            }
            function updateRequired(value) {
                $("#10_year").prop('required', value);
                $("#10_univercity").prop('required', value);
                $("#12_Year").prop('required', value);
                $("#12_univercity").prop('required', value);
                $("#ug_Year").prop('required', value);
                $("#ug_univercity").prop('required', value);
            }
        </script>
</x-app-layout>
