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

  <h1 class="text-3xl font-semibold">Seller Settings</h1>


<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
  <div>

  <label class="block  text-sm  font-normal transition-normal mb-2">Seller Name </label>

  <input type="text" class=" mt-1 border border-gray-300   focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="sellername" 
   value="{{ old('sellername', $seller->sellername ?? '') }}">

  </div> 

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

</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">


    <div>

         <label class="block  text-sm  font-normal transition-normal mb-2">Address1 </label>

  <input type="text" class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="address1"
   value="{{ old('address1', $seller->address1 ?? '') }}">

  </div> 

  <div>

   <label class="block  text-sm  font-normal transition-normal mb-2">Address2 </label>

  <input type="text" class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="address2"
   value="{{ old('address2', $seller->address2 ?? '') }}">

</div>



</div>


<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <div>

         <label class="block  text-sm  font-normal transition-normal mb-2">Landmark </label>

  <input type="text" class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="landmark"
   value="{{ old('landmark', $seller->landmark ?? '') }}">

  </div> 

  <div>

   <label class="block  text-sm  font-normal transition-normal mb-2">City </label>

  <input type="text" class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="city"
   value="{{ old('city', $seller->city ?? '') }}">

</div>



</div>


<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <div>

         <label class="block  text-sm  font-normal transition-normal mb-2">State </label>

  <input type="text" class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="state"
   value="{{ old('state', $seller->state ?? '') }}">

  </div> 

  <div>

   <label class="block  text-sm  font-normal transition-normal mb-2">Country </label>

  <!-- <input type="text" class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="countryid"> -->


  <select class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="countryid" >

    @foreach ($countrylist as $country)
    <option value="{{ $country->countryid }}"    @if ($country->countryid == $seller->countryid) selected @endif >{{ $country->countryname }}</option>

    @endforeach;
    
</select>


</div>





</div>


<div class="grid grid-cols-1 md:grid-cols-3 gap-4">

    <div>

         <label class="block  text-sm  font-normal transition-normal mb-2">Primary Contact </label>

  <input type="text" class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="primarycontact"  value="{{ old('sellername', $seller->primarycontact ?? '') }}">

  </div> 

  <div>

   <label class="block  text-sm  font-normal transition-normal mb-2">Mobile No. </label>

  <input type="text" class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="mobileno"
   value="{{ old('mobileno', $seller->mobileno ?? '') }}">

</div>



<div>

   <label class="block  text-sm  font-normal transition-normal mb-2">Postal Code </label>

  <input type="text" class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="postalcode"
   value="{{ old('postalcode', $seller->postalcode ?? '') }}">

</div>


</div>


<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <div>

         <label class="block  text-sm  font-normal transition-normal mb-2">Website URL </label>

  <input type="text" class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400"  id="websiteurl"
   value="{{ old('websiteurl', $seller->websiteurl ?? '') }}">

  </div> 

  <div>

   <label class="block  text-sm  font-normal transition-normal mb-2"> Business Category </label>

  <input type="text" class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="businesscategory"
   value="{{ old('businesscategory', $seller->businesscategory ?? '') }}">

</div>





</div>


<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <div>

         <label class="block  text-sm  font-normal transition-normal mb-2">Business Industry </label>

  <input type="text" class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="businessindustry"
   value="{{ old('businessindustry', $seller->businessindustry ?? '') }}">

  </div> 

  <div>

   <label class="block  text-sm  font-normal transition-normal mb-2"> Location Link </label>

  <input type="text" class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="locationlink"
   value="{{ old('locationlink', $seller->locationlink ?? '') }}">

</div>





</div>



<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <div>

         <label class="block  text-sm  font-normal transition-normal mb-2">Tax Name </label>

  <input type="text" class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="taxname"
   value="{{ old('taxname', $seller->taxname ?? '') }}">

  </div> 

  <div>

   <label class="block  text-sm  font-normal transition-normal mb-2"> Estd. Year </label>

  <input type="text" class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="estdYear"
   value="{{ old('estdYear', $seller->estdYear ?? '') }}">

</div>


</div>

  <div>

   <label class="block  text-sm  font-normal transition-normal mb-2"> Keywords </label>

  <textarea name="keywords" rows="3" class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="keywords">{{ old('keywords', $seller->keywords ?? '') }}</textarea>

</div>


  <div>

   <label class="block  text-sm  font-normal transition-normal mb-2"> Business Description </label>

  <textarea name="keywords" rows="3" class=" border border-gray-300  focus-visible: w-full focus:border-indigo-500 focus:outline-none focus:ring-2  focus:ring-blue-400" id="description"> {{ old('description', $seller->description ?? '') }}</textarea>

</div>


   <div class="pt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md" id="savesettings">
                Save
            </button>
        </div>



</form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>