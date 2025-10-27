<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\seller;

use App\Models\slrprofile;

use App\Models\Firm;

use App\Models\items;


use App\Models\countrylist;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;

use App\Mail\PasswordResetMail;

use Illuminate\Support\Str;


use Illuminate\Support\Facades\Hash;

use PDF;
use App\itemsPDF;

class sellerController extends Controller
{
    public function login()
    {
        return view('seller.login');
    }


     public function signupView()
    {
        return view('seller.signup');
    }


    public function signup(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'sellername' => 'required|string|max:255',
            'mailid' => 'required|email|unique:sellers,mailid',
            'password' => 'required|string|min:6'
        ]);

        try {
            // Create seller (not User)
            $seller = seller::create([
                'sellername' => $validated['sellername'],
                'mailid' => $validated['mailid'],
                'adminpw' => Hash::make($validated['password']),
            ]);


            // Create slrprofile with same sellerid
            slrProfile::create([
              'sellerid' => $seller->sellerid,
                'address1' => '',
                'address2' => '',
                'landmark' => '',
                'city' => '',
                'state' => '',
                'countryid' => 0,
                'primarycontact' => '',
                'postalcode' => '',
                'mobileno' => '',
                'websiteurl' => '',
                'businesscategory' => '',
                'businessindustry' => '',
                'locationlink' => '',
                'taxname' => '',
                'keywords' => '',
             
                'description' => '',
                'estdYear' => '',
                'sonotify' => 'N',
            ]);

// Generate a unique slrrefid
function generateUniqueRefId() {
    $maxAttempts = 1000;
    $attempts = 0;

    do {
        $randomNumber = rand(1000001, 9999999);
        $refId = substr($randomNumber, 0, 3) . '-' . substr($randomNumber, 3, 2) . '-' . substr($randomNumber, 5, 2);
        $existingRecord = seller::where('slrrefid', $refId)->first();
        $attempts++;
    } while (!empty($existingRecord) && $attempts < $maxAttempts);

    if ($attempts >= $maxAttempts) {
        throw new \Exception("Please try again after some time.");
    }

    return $refId;
}

$sellerRecord = seller::find($seller->sellerid);
$sellerRecord->dbname = "dmrapp_dmrslr" . $seller->sellerid;
$sellerRecord->slrrefid = generateUniqueRefId();
$sellerRecord->save();


$databaseName = $sellerRecord -> dbname;

//create new databse for this specific seller

\DB::statement ("CREATE DATABASE `$databaseName`");



   // ✅ Dynamically configure DB connection for that new DB
        config([
            'database.connections.dynamic' => [
                'driver' => 'mysql',
                'host' => env('DB_HOST', '127.0.0.1'),
                'port' => env('DB_PORT', '3306'),
                'database' => $databaseName,
                'username' => env('DB_USERNAME', 'root'),
                'password' => env('DB_PASSWORD', ''),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
            ],
        ]);


        \DB::connection('dynamic') -> statement ("CREATE TABLE IF NOT EXISTS `firms` (
  `firmno` tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
  `creationTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `firmname` varchar(100) NOT NULL,
  `firmcode` varchar(10) NOT NULL,
  `taxregno` varchar(30) NOT NULL,
  `firmstatus` varchar(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`firmno`),
  UNIQUE KEY `firmname` (`firmname`),
  UNIQUE KEY `firmcode` (`firmcode`)
) ENGINE=InnoDB");


   \DB::connection('dynamic') -> statement ("CREATE TABLE IF NOT EXISTS `items` (
  `itemno` mediumint UNSIGNED NOT NULL AUTO_INCREMENT,
  `creationTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `itemname` varchar(250) NOT NULL,
  `itemcode` varchar(30) NOT NULL DEFAULT '',
  `itemname2` varchar(250) NOT NULL DEFAULT '',
  `firmno` tinyint UNSIGNED DEFAULT NULL,
  `itemgroup1` varchar(30) NOT NULL DEFAULT '',
  `itemgroup2` varchar(30) NOT NULL DEFAULT '',
  `unit1` varchar(15) NOT NULL,
  `unit2` varchar(15) NOT NULL DEFAULT '',
  `units` smallint UNSIGNED DEFAULT NULL,
  `unitname` varchar(40) NOT NULL,
  `itemspec` text NOT NULL,
  `itemstatus` varchar(1) NOT NULL DEFAULT 'A',
  `totalordernos` mediumint UNSIGNED DEFAULT '0',
  `translateditems` varchar(250) NOT NULL DEFAULT '',
  `itemnamekeywords` text NOT NULL,
  `include_orderform` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`itemno`),
  UNIQUE KEY `itemname` (`itemname`)
) ENGINE=InnoDB");



            return response()->json([
                'success' => true,
                'message' => 'Signup successful!',
                'seller' => $seller
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating account: ' . $e->getMessage()
            ], 500);
        }
    }


    public function loginValidation (Request $request) {


         // Validate the request
       $validated = $request->validate([
        'mailid' => 'required|email',
        'password' => 'required|string|min:6',
    ]);


        try {

            $seller = seller::where('mailid', $validated['mailid'])-> first();


            if(!$seller) {

            return response () -> json ( [
                    'success' => false ,
                    'message' => 'username is invalid'
            ], 401);
            
            

            }



            if (!Hash::check($validated['password'], $seller->adminpw) ) {


                return response () -> json ([
                    'success' => false ,
                    'message' => 'username or password invalid'
                ],401);
            }

            // ✅ Store seller ID in session
            session (['sellerid' => $seller->sellerid]);

               return response()->json([
            'success' => true,
            'message' => 'Login successful!',
            'seller' => $seller
        ], 200);



        }

        catch (\Exception $e) {

            return response () -> json ([
                'success' => false,
                'message' => 'Error :'. $e -> getMessage()
            ],500);

        }



    }


    public function settings () {


        $sellerid = session('sellerid');

    if (!$sellerid) {
        return redirect()->route('login')->with('error', 'Please login first');
    }

    // Fetch seller and related profile
    $seller = \DB::table('sellers')
        ->join('slrprofiles', 'sellers.sellerid', '=', 'slrprofiles.sellerid')
        ->join('countrylists', 'slrprofiles.countryid', '=', 'countrylists.countryid')
        ->where('sellers.sellerid', $sellerid)
        ->select(
            'sellers.sellername',
            'sellers.adminpw',
            'sellers.staffpw',
            'slrprofiles.*',
            'countrylists.countryname'
        )
        ->first();


         $countrylist = countrylist::all();


        // return view ('seller.settings',['countrylist' => $countrylist]);

         return view('seller.settings', compact('seller', 'countrylist'));
    }


    function connectSellerDB($dbname)
{
    config([
        'database.connections.dynamic' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => $dbname,
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
        ],
    ]);

    return \DB::connection('dynamic');
}


    public function firms () {

        $sellerid = session ('sellerid');

        if (!$sellerid) {


            return redirect()->route('login')->with('error','Please login first');
        }

        $dbname = "dmrapp_dmrslr".$sellerid;

        //  $firms = $this->connectSellerDB($dbname)->table('firms')->get(); //direct connection to firms table without model

        $this -> connectSellerDB ($dbname);

        //Use firm modal with dynamic connection

        $firmModel = new Firm();

        $firmModel->setConnection ('dynamic');


        $firms = $firmModel->all();

        return view ('seller.firm', ['firms' => $firms]);
    }


 public function savefirm(Request $request)
{
    $sellerid = session('sellerid');

    if (!$sellerid) {
        return redirect()->route('seller.login')->with('error', 'Please login first');
    }

    $validated = $request->validate([
        'firmname' => 'required|string|max:100',
        'firmcode' => 'required|string|max:10',
        'taxregno' => 'required|string|max:30',
    ]);

    // ✅ Correct DB name
    $dbname = "dmrapp_dmrslr" . $sellerid;

    // ✅ Call your helper to configure dynamic connection
    $this->connectSellerDB($dbname);

    // ✅ Create firm using dynamic connection
    $firm = new Firm();
    $firm->setConnection('dynamic');
    $firm->firmname = $validated['firmname'];
    $firm->firmcode = $validated['firmcode'];
    $firm->taxregno = $validated['taxregno'];
    $firm->save();

    return response()->json([
        'success' => true,
        'message' => 'Firm saved successfully!',
    ], 201);
}



public function getFirm($firmno)
{
    $sellerid = session('sellerid');
    if (!$sellerid) {
        return response()->json(['success' => false, 'message' => 'Please login first'], 401);
    }

    $dbname = "dmrapp_dmrslr" . $sellerid;
    $this->connectSellerDB($dbname);

    $firm = \App\Models\Firm::on('dynamic')->find($firmno);

    if (!$firm) {
        return response()->json(['success' => false, 'message' => 'Firm not found'], 404);
    }

    return response()->json([
        'success' => true,
        'firm' => $firm
    ]);
}



public function editFirm(Request $request,$firmno)
{
    $sellerid = session('sellerid');
    if (!$sellerid) {
        return response()->json(['success' => false, 'message' => 'Please login first'], 401);
    }


     $validated = $request->validate([
        'firmname' => 'required|string|max:100',
        'firmcode' => 'required|string|max:10',
        'taxregno' => 'required|string|max:30',
    ]);



    $dbname = "dmrapp_dmrslr" . $sellerid;
    $this->connectSellerDB($dbname);

    $firm = \App\Models\Firm::on('dynamic')->find($firmno);

    if (!$firm) {
        return response()->json(['success' => false, 'message' => 'Firm not found'], 404);
    }

     $firm->firmname = $validated['firmname'];
    $firm->firmcode = $validated['firmcode'];
    $firm->taxregno = $validated['taxregno'];
    $firm->save();

    return response()->json([
        'success' => true,
        'firm' => $firm
    ]);
}


public function deletefirm ($firmno) {

     $sellerid = session('sellerid');
    if (!$sellerid) {
        return response()->json(['success' => false, 'message' => 'Please login first'], 401);
    }


       $dbname = "dmrapp_dmrslr" . $sellerid;
    $this->connectSellerDB($dbname);

    $firm = \App\Models\Firm::on('dynamic')->find($firmno);

    if (!$firm) {
        return response()->json(['success' => false, 'message' => 'Firm not found'], 404);
    }

    $firm->delete();


      return response()->json([
        'success' => true,
        'firm' => $firm
    ]);

}


public function savesetting (Request $request) {


   $validated = $request->validate([
    'sellername' => 'required|string|max:100',
    'adminpassword' => 'nullable|string|min:6|max:100',
    'staffpassword' => 'nullable|string|max:100',
    'address1' => 'nullable|string|max:100',
    'address2' => 'nullable|string|max:100',
    'landmark' => 'nullable|string|max:100',
    'city' => 'nullable|string|max:50',
    'state' => 'nullable|string|max:50',
    'countryid' => 'required|integer|min:1|max:65535',
    'primarycontact' => 'nullable|string|max:50',
    'postalcode' => 'nullable|string|max:20',
    'mobileno' => 'nullable|string|max:15',
    'websiteurl' => 'nullable|string|max:50',
    'businesscategory' => 'nullable|string|max:25',
    'businessindustry' => 'nullable|string|max:100',
    'locationlink' => 'nullable|string|max:250',
    'taxname' => 'nullable|string|max:50',
    'keywords' => 'nullable|string',
    'description' => 'nullable|string|max:250',
    'estdYear' => 'nullable|string|max:4'
]);



        $sellerid = session ('sellerid');

        $seller = seller::find($sellerid);


        $seller -> sellername = $validated['sellername'];


        // $seller -> adminpw  = $validated['adminpassword'];

        // $seller -> staffpw  = $validated['staffpassword'];

         $seller->adminpw = Hash::make($validated['adminpassword']);

        // only update staff password if provided and filled (non-empty)
        if ($request->filled('staffpassword')) {
            $seller->staffpw = Hash::make($validated['staffpassword']);
        }

        $seller -> save();


        // $slrprofile = slrProfile::find($sellerid);

        
        $slrprofile = slrProfile::where('sellerid',$sellerid)-> first();

        // seller::where('mailid', $validated['mailid'])-> first()


        $slrprofile -> address1 = $validated ['address1'];

        $slrprofile -> address2 = $validated ['address2'];

        $slrprofile -> landmark = $validated['landmark'];

         $slrprofile -> city = $validated['city'];
          $slrprofile -> state = $validated['state'];
          $slrprofile -> countryid = $validated['countryid'];
           $slrprofile -> primarycontact = $validated['primarycontact'];

            $slrprofile -> postalcode = $validated['postalcode'];

             $slrprofile -> mobileno = $validated['mobileno'];
              $slrprofile -> websiteurl = $validated['websiteurl'];

               $slrprofile -> businesscategory = $validated['businesscategory'];

                $slrprofile -> businessindustry = $validated['businessindustry'];

                 $slrprofile -> locationlink = $validated['locationlink'];


                  $slrprofile -> taxname = $validated['taxname'];
                   $slrprofile -> keywords = $validated['keywords'];
                    $slrprofile -> description = $validated['description'];
                     $slrprofile -> estdYear = $validated['estdYear'];


                     $slrprofile -> save();
                     

                      return response()->json([
        'success' => true,
        'message' => 'Settings updated successfully!',
    ], 201);

}

public function forgot () {

    return view('seller.forgot');
}


public function forgotPassword(Request $request)
{
    $request->validate([
        'mailid' => 'required|email',
    ]);

    $seller = Seller::where('mailid', $request->mailid)->first();

    if (!$seller) {
        return response()->json(['success' => false, 'message' => 'Email not found.'], 404);
    }

    // Generate new random password
    $newPassword = Str::random(8);

    // Update in database (hashed)
    $seller->adminpw = Hash::make($newPassword);
    $seller->save();

    // Send email
    Mail::to($seller->mailid)->send(new PasswordResetMail($seller->sellername, $newPassword));

    return response()->json(['success' => true, 'message' => 'A new password has been sent to your email.']);
}


public function additems () {

    return view('seller.additems');
}


public function saveitem (Request $request) {

    $validated = $request -> validate ([
                         'itemname' => 'required|string|max:250',
                         'itemcode' => 'nullable|string|max:30',
                         'unit1'   =>  'required|string|max:15',
                         'unit2'   => 'nullable|string|max:15',
                         'units' => 'nullable|integer|min:1|max:65535',
                         'itemgroup1' => 'nullable|string|max:30',
                         'itemgroup2' => 'nullable|string|max:30'

    ]);


      $sellerid = session('sellerid');

    if (!$sellerid) {
        return redirect()->route('seller.login')->with('error', 'Please login first');
    }



 // ✅ Correct DB name
    $dbname = "dmrapp_dmrslr" . $sellerid;

    // ✅ Call your helper to configure dynamic connection
    $this->connectSellerDB($dbname);

    // ✅ Create firm using dynamic connection
    $items = new items();
    $items->setConnection('dynamic');
    $items->itemname = $validated['itemname'];
    $items->itemcode = $validated['itemcode'];
    $items -> unit1 = $validated['unit1'];
        $items -> unit2 = $validated['unit2'];

            $items -> units = $validated['units'];
            $items -> itemgroup1 = $validated['itemgroup1'];
            
                $items -> itemgroup2 = $validated['itemgroup2'];

                if($validated['units'] == NULL) {

                   $validated['units']  = 1;
                    $items -> units = 1;
                }

              if ($validated['units'] == 1)  {

                $items -> unitname = $validated['unit1'];

              }

              else{

                $items -> unitname = $validated['unit1'].' of '.$validated['units'].' '.$validated['unit2'];
              }
    $items->save();

       return response()->json([
        'success' => true,
        'items' => $items
    ]);

}

public function itemlist(Request $request) {
    $sellerid = session('sellerid');

    if (!$sellerid) {
        return redirect()->route('login')->with('error', 'Please login first');
    }

    $dbname = "dmrapp_dmrslr" . $sellerid;
    $this->connectSellerDB($dbname);

    $itemModel = new items();
    $itemModel->setConnection('dynamic');

    $search = $request->input('search');
    $category = $request->input('category');
    $brand = $request->input('brand');

    $query = $itemModel::query();

    // Apply filters
    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $q->where('itemname', 'like', "%{$search}%")
              ->orWhere('itemgroup1', 'like', "%{$search}%")
              ->orWhere('itemgroup2', 'like', "%{$search}%")
              ->orWhere('unitname', 'like', "%{$search}%");
        });
    }

    if (!empty($category)) {
        $query->where('itemgroup1', '=', $category);
    }

    if (!empty($brand)) {
        $query->where('itemgroup2', '=', $brand);
    }

    // CRITICAL: Execute the query
    $items = $query->get();

    return view('seller.itemlist', ['items' => $items]);
}


public function editItem(Request $request)
{
    $sellerid = session('sellerid');

    if (!$sellerid) {
        return redirect()->route('login')->with('error', 'Please login first');
    }

    $dbname = "dmrapp_dmrslr" . $sellerid;
    $this->connectSellerDB($dbname);

    $itemModel = new \App\Models\items();
    $itemModel->setConnection('dynamic');

    $itemno = $request->input('itemno');

    $item = $itemModel->where('itemno', $itemno)->first();

    if (!$item) {
        return redirect()->back()->with('error', 'Item not found.');
    }

    return view('seller.edititems', ['item' => $item]);
}

public function exportToPDF()
{
    $sellerid = session('sellerid');
    $dbname = "dmrapp_dmrslr".$sellerid;
    $this->connectSellerDB($dbname);

    $itemModel = new items();
    $itemModel->setConnection('dynamic');
    $items = $itemModel->all();

    // Load Blade view into PDF
    $pdf = PDF::loadView('seller.items_pdf', compact('items'));

    // Download the file
    return $pdf->download('ItemsList.pdf');
}

}