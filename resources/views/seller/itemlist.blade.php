<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Items - Demander</title>
 <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
  <script src="https://cdn.tailwindcss.com"></script>

 
</head>
<body class="bg-white min-h-screen flex flex-col justify-between">



<div class=" p-5 h-screen bg-gray-100">

<h1 class="text-xl mb-2"> Items List</h1>


<form method="GET" action="{{ route('items') }}" class="flex justify-center mb-4">
    <input 
        type="text" 
        name="search" 
        id="searchInput" 
        placeholder="Quick Search : Ctrl + Q" 
        value="{{ request('search') }}" 
        class="border border-gray-300 rounded-lg p-2 w-1/2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
    >
    <button type="submit" class="ml-2 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
        Search
    </button>
</form>

<div class="mt-1 ms-3 ">
    <button onclick="openFilterModal()"
        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition float-right mb-4">
        Filter
    </button>
</div>

<!-- Modal Trigger Button -->
<div class="mt-1 ms-3 ">
    <button onclick="openAddItems()"
        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition float-right mb-4">
        + Add Item
    </button>
</div>

<!-- {{ route('items.pdf') }} -->
<a href="" 
   class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700" id="pdfBtn">
   Export to PDF
</a>


<a href="" 
   class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700" id="excelBtn">
   Export to Excel
</a>

<table class="w-full" id="itemsTable">

<thead class="bg-gray-50 border-b-2 border-gray-200">

  <!-- <th class="p-3 text-lg  font-mono tracking-normal text-left"> # </th> -->

  <th class="p-3 text-lg  font-mono tracking-normal text-left"> Item Name </th>

  <th class="p-3 text-lg font-mono tracking-normal text-left"> Category </th>



 <th class="p-3 text-lg font-mono  text-left tracking-normal"> Brand </th>

 <th class="p-3 text-lg font-mono  text-left tracking-normal"> Unit Name </th>

 <th class="p-3 text-lg font-mono  text-left tracking-normal"></th>
</thead>

<tbody>

@php $i = 0; @endphp
@foreach ($items as $item)

 @php $i++; @endphp

<tr class="bg-white">

     <!-- <td class="p-3 text-sm text-gray-700">{{ $i }}</td> -->

     <td class="p-3 text-sm text-gray-700"> {{ $item->itemname }}</td>

     <td class="p-3  text-gray-700 text-sm  ">{{ $item->itemgroup1 }}</td>



     <td class="p-3 text-sm text-gray-700"> {{ $item->itemgroup2 }}</td>

     <td class="p-3 text-sm text-gray-700"> {{ $item->unitname }}</td>

    

       <td style=" text-center">


     <!-- <span alt="Edit" class="edit-btn mr-3 me-3" title="Edit Firm" style="cursor:pointer;color: #0066cc;font-weight:500;" data-itemno = '{{ $item -> itemno }}'  >Edit</span>
       -->
  <form action="{{ route('edititems') }}" method="POST" style="display:inline;">
    @csrf
    <input type="hidden" name="itemno" value="{{ $item->itemno }}">
    <button type="submit" title="Edit">
        <img src="{{ asset('images/Edit Icon-1.png') }}" alt="Edit" width="18" height="18" style="margin-right: 8px;">
    </button>
</form>


   </a>
     </td>
</tr>

@endforeach

</tbody>


</table>



<div id="filterModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative">

        <!-- Modal Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Filter</h2>
            <button onclick="closeFilterModal()" class="text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</button>
        </div>

        <!-- Modal Body -->
        <form id="filterForm" method="POST" action="">
            @csrf
            <div class="space-y-4">
                <!-- Firm Name -->
                <div>
                    <label for="firmname" class="block text-sm font-medium text-gray-700">Category</label>
                    <!-- <input type="text" name="category" id="firmname"
                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        placeholder="Enter firm name" > -->

                        <select id="category" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                          
                        @foreach ($items as $item)
                         <option value="{{ $item->itemgroup1 }}">{{ $item->itemgroup1 }}</option>


                         @endforeach

                        </select>
                </div>

                <!-- Firm Code -->
                <div>
                    <label for="firmcode" class="block text-sm font-medium text-gray-700">Brand</label>
                    <select id="brand" class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                        @foreach ($items as $item)
                         <option value="{{ $item->itemgroup2 }}">{{ $item->itemgroup2 }}</option>


                         @endforeach


                        </select>
                </div>

           
            <!-- Modal Footer -->
            <div class="flex justify-end mt-6 space-x-3">
                <button type="button" onclick="closeFilterModal()"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition applyBtn">
                    Apply
                </button>
            </div>
        </form>
    </div>
</div>






</div>



   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- jsPDF Core -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<!-- jsPDF AutoTable Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>

<!-- SheetJS for Excel export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.19.3/xlsx.full.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.0/exceljs.min.js"></script>


    <script>

         function openFilterModal() {
        document.getElementById('filterModal').classList.remove('hidden');
    }

    function closeFilterModal() {
        document.getElementById('filterModal').classList.add('hidden');
        document.getElementById('filterForm').reset();

         $('#category').val('');

          $('#brand').val('');

          window.location.href = '/itemslist';
    
    }


    function openAddItems()  {

       window.location.href = '/additems';
    }
  
// Ensure libraries are loaded
function checkLibraries() {
    if (typeof jspdf === 'undefined' || typeof XLSX === 'undefined') {
        alert('Required libraries (jsPDF or XLSX) are not loaded. Please check your script includes.');
        return false;
    }
    return true;
}

// Helper function for date formatting
function formatDate(date) {
    const pad = (n) => n < 10 ? '0' + n : n;
    return `${date.getFullYear()}${pad(date.getMonth() + 1)}${pad(date.getDate())}`;
}



    



$('#pdfBtn').click(function (e) {


    // alert("click")

     const table = document.getElementById('itemsTable');

     const formName = "Items List";

    // exportToPDF(table,formName,"ItemsList","1")

    exportToPDF(table,formName2,"ItemsList","1")


});




$('#excelBtn').click(function (e) {


    // alert("click")

     const table = document.getElementById('itemsTable');

     const formName = "Items List";

     exportToExcel(table,formName,"ItemsList","1")

    // exportToPDF(table,formName,"ItemsList")


});
        </script>

        

</body>
</html>

