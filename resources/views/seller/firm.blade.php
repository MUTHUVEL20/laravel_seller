<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Firms - Demander</title>
 <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
  <script src="https://cdn.tailwindcss.com"></script>

 
</head>
<body class="bg-white min-h-screen flex flex-col justify-between">



<div class=" p-5 h-screen bg-gray-100">

<h1 class="text-xl mb-2"> Firms</h1>

<!-- Modal Trigger Button -->
<div class="mt-1 ">
    <button onclick="openFirmModal()"
        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition float-right mb-4">
        + Add New Firm
    </button>
</div>

<a href="" 
   class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700" id="pdfBtn">
   Export to PDF
</a>
<table class="w-full" id="firmsTable">

<thead class="bg-gray-50 border-b-2 border-gray-200">

  <th class="p-3 text-lg  font-mono tracking-normal text-left"> # </th>

  <th class="p-3 text-lg  font-mono tracking-normal text-left"> Code </th>

  <th class="p-3 text-lg font-mono tracking-normal text-left"> Firm Name </th>



 <th class="p-3 text-lg font-mono  text-left tracking-normal"> GST Reg.No. </th>

 <th class="p-3 text-lg font-mono  text-left tracking-normal">status </th>


</thead>

<tbody>

@php $i = 0; @endphp
@foreach ($firms as $firm)

 @php $i++; @endphp

<tr class="bg-white">

     <td class="p-3 text-sm text-gray-700">{{ $i }}</td>

     <td class="p-3 text-sm text-gray-700"> {{ $firm->firmcode }}</td>

     <td class="p-3  text-gray-700 text-sm  ">{{ $firm->firmname }}</td>



     <td class="p-3 text-sm text-gray-700"> {{ $firm->taxregno }}</td>

     <!-- <td class="p-3 text-sm text-gray-700"> {{ $firm->firmstatus }}</td> -->

     @if ($firm->firmstatus === 'A') 

      <td class="p-3 text-sm "><span class="p-1.5 text-xs font-medium uppercase tracking-wider bg-yellow-200" > Active </span></td>
      
      @else 


           <td class="p-3 text-sm text-gray-700"><span class="p-1.5 text-xs font-medium uppercase tracking-wider bg-red-500 text-white" > Inactive</td>

      @endif

       <td style=" text-center">


     <span alt="Edit" class="edit-btn mr-3 me-3" title="Edit Firm" style="cursor:pointer;color: #0066cc;font-weight:500;" data-firmno = '{{ $firm -> firmno }}'  >Edit</span>
      

     <img src="{{ asset('images/DELETE-1.png') }}" alt="Delete" class="delete-btn cursor-pointer w-5 h-5 inline-block" title="Delete Firm" data-firmno = '{{ $firm -> firmno }}' style=""  >
      

     </td>
</tr>

@endforeach

</tbody>


</table>


<!-- Firm Add Modal -->
<div id="firmModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative">

        <!-- Modal Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Add New Firm</h2>
            <button onclick="closeFirmModal()" class="text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</button>
        </div>

        <!-- Modal Body -->
        <form id="firmForm" method="POST" action="">
            @csrf
            <div class="space-y-4">
                <!-- Firm Name -->
                <div>
                    <label for="firmname" class="block text-sm font-medium text-gray-700">Firm Name</label>
                    <input type="text" name="firmname" id="firmname"
                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        placeholder="Enter firm name" required>
                </div>

                <!-- Firm Code -->
                <div>
                    <label for="firmcode" class="block text-sm font-medium text-gray-700">Firm Code</label>
                    <input type="text" name="firmcode" id="firmcode"
                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        placeholder="Enter firm code" required>
                </div>

                <!-- Tax Reg No -->
                <div>
                    <label for="taxregno" class="block text-sm font-medium text-gray-700">Tax Reg No</label>
                    <input type="text" name="taxregno" id="taxregno"
                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        placeholder="Enter tax registration number">
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end mt-6 space-x-3">
                <button type="button" onclick="closeFirmModal()"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition savefirm">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>





<!-- Firm Add Modal -->
<div id="firmEditModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative">

        <!-- Modal Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Add New Firm</h2>
            <button onclick="closeFirmModal()" class="text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</button>
        </div>

        <!-- Modal Body -->
        <form id="firmEditForm" method="POST" action="">
            @csrf
            <div class="space-y-4">
                <!-- Firm Name -->
                <div>
                    <label for="firmname" class="block text-sm font-medium text-gray-700">Firm Name</label>
                    <input type="text" name="firmname" id="firmnameEdit"
                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        placeholder="Enter firm name" required>
                </div>

                <!-- Firm Code -->
                <div>
                    <label for="firmcode" class="block text-sm font-medium text-gray-700">Firm Code</label>
                    <input type="text" name="firmcode" id="firmcodeEdit"
                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        placeholder="Enter firm code" required>
                </div>

                <!-- Tax Reg No -->
                <div>
                    <label for="taxregno" class="block text-sm font-medium text-gray-700">Tax Reg No</label>
                    <input type="text" name="taxregno" id="taxregnoEdit"
                        class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        placeholder="Enter tax registration number">
                </div>

                <input id="firmno"  class="w-full mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end mt-6 space-x-3">
                <button type="button" onclick="closeFirmModal()"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition editfirm">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>





</div>



   
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('js/app.js') }}"></script>


    <!-- jsPDF Core -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<!-- jsPDF AutoTable Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>

<!-- SheetJS for Excel export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.19.3/xlsx.full.min.js"></script>

    <script>

         function openFirmModal() {
        document.getElementById('firmModal').classList.remove('hidden');
    }

    function closeFirmModal() {
        document.getElementById('firmModal').classList.add('hidden');
        document.getElementById('firmForm').reset();


         document.getElementById('firmEditModal').classList.add('hidden');
        document.getElementById('firmEditModal').reset();
    }


    
  

// delete-btn


$('#pdfBtn').click(function (e) {


    // alert("click")

     const table = document.getElementById('firmsTable');

     const formName = "Firms";

    exportToPDF(table,formName,"FirmsList")


});
    
        </script>

</body>
</html>

