<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Seller Settings - Laravel Demo</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body class="">
<form class="px-4 my-2 max-w-3xl mx-auto space-y-10 ">

  <h1 class="text-3xl font-semibold">Add Items</h1>


<!-- <div class="grid grid-cols-1 md:grid-cols-3 gap-4">


   <div >

  <label class="block  text-sm  font-normal transition-normal mb-2">Admin Password</label>

  <input type="text" class=" border border-gray-300  focus-visible:  w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="adminpassword"
  value="">

  </div> 


   <div>

  <label class="block  text-sm  font-normal transition-normal mb-2">Staff Password </label>

  <input type="text" class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="staffpassword"
  value="">

  </div> 

</div> -->

  <div>

  <label class="block  text-sm  font-normal transition-normal mb-2">Item Name </label>

  <input type="text" class=" mt-1 border border-gray-300   focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="itemname" 
   value="{{ old('itemname') }}">

  </div> 


    <div>

  <label class="block  text-sm  font-normal transition-normal mb-2">Item Code </label>

  <input type="text" class=" mt-1 border border-gray-300   focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="itemcode" 
   value="{{ old('itemcode') }}">

  </div> 

<div class="grid grid-cols-1 md:grid-cols-4 gap-6">


    <div>

         <label class="block  text-sm  font-normal transition-normal mb-2">Measure Unit Type </label>


          <select class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="measureUnitType" >

  
    <option value="Simple"> Simple </option>

      <option value="Compound"> Compound </option>

 
    
</select>

        

  </div> 

  <div>

   <label class="block  text-sm  font-normal transition-normal mb-2">Measure Unit </label>

  <input type="text" class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="unit1"
   value="{{ old('unit1') }}">

</div>


  <div>

 
<label class="block  text-sm  font-normal transition-normal mb-7"> </label>
  <input type="text" class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="units"
   value="{{ old('units') }}">

</div>



  <div>

<label class="block  text-sm  font-normal transition-normal mb-7"> </label>

  <input type="text" class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="unit2"
   value="{{ old('unit2') }}">

</div>


</div>


 <div>

  <label class="block  text-sm  font-normal transition-normal mb-2">Category </label>

  <input type="text" class=" mt-1 border border-gray-300   focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="itemgroup1" 
   value="{{ old('itemgroup1') }}">

  </div> 

   <div>

  <label class="block  text-sm  font-normal transition-normal mb-2">Brand </label>

  <input type="text" class=" mt-1 border border-gray-300   focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="itemgroup2" 
   value="{{ old('itemgroup2') }}">

  </div> 



  <div>

   <label class="block  text-sm  font-normal transition-normal mb-2"> Item Description </label>

  <textarea name="description" rows="3" class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="itemspec">{{ old('description') }}</textarea>

</div>




   <div class="pt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md" id="additems">
                Save
            </button>
        </div>



</form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>