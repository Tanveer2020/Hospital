<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Doctor;

use Illuminate\Support\Facades\Auth;

use App\Models\Appointment;

use Notification;

use App\Notification\SendEmailNotification;

class AdminController extends Controller
{
    
  public function addview(){

    if(Auth::id()){

      if(Auth::user()->usertype == 1){

         return view('admin.add_doctor');
      }

      else{

        return redirect()->back();
      }

    }

    else{

      return redirect('login');
    }

  }

  public function upload(Request $request){
    
    // dd( $request->all());

   
// if ($image = $request->file('image')) {
//             $destinationPath = 'image/';
//              $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
//             $image->move($destinationPath, $profileImage);
//             $input['image'] = "$profileImage";
//         }

      $filename = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $filename);

    $doctor = Doctor::create([
     

     'name' => $request->name,
     'phone' => $request->number,
     'speciality' => $request->speciality,
     'room'     => $request->room,
     'image'   => $filename,

    ]

      );

    return redirect()->back()->with('success','Doctor Added Successfully');

  }


    public function show_appointment(){

      if(Auth::id()){

        if(Auth::user()->usertype==1){

           $appointments = Appointment::all();

      return view('admin.showappointment',compact('appointments'));

      }

        else {

          return redirect()->back();
        }

         }

         else
         {

          return redirect('login');
         }

         } 

    public function approved($id){

      $appointment = Appointment::find($id);

      $appointment->status = "approved";

      $appointment->save();

      return redirect()->back();
    
    }

    public function canceled($id){

      $appointment = Appointment::find($id);

      $appointment->status = "canceled";


      $appointment->save(); 

 
      return redirect()->back();
    }


    public function showdoctor()
    {
     
      $doctors = Doctor::all();
      return view('admin.showdoctor',compact('doctors'));
    }

    public function deletedoctor($id){

      $doctor = Doctor::find($id);

      $doctor->delete();

      return redirect()->back();
    }

    public function updatedoctor($id){

      $doctors = Doctor::find($id);

      return view('admin.update_doctor',compact('doctors'));
    }

    
    public function editdoctor(Request $request, $id){


         $filename = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $filename);
    
    $doctors = Doctor::find($id);
    
    $doctors->update([

      'name' => $request->name,

       'phone' => $request->number,
       'speciality' => $request->speciality,

       'room'  => $request->room,

       'image' => isset($filename) ? $filename : $doctors->image,



       

    ]);

    return redirect()->back()->with('success','Doctor updated successfully');


    }


    public function emailview($id){

      $appointment = Appointment::find($id);

      return view('admin.email_view',compact('appointment'));
    }
    
    public function sendmail(Request $request, $id){

    $appointment = Appointment::find($id);

    $details = [
       
       'greeting' => $request->greeting,

       'body'    =>  $request->body,

       'actiontext' => $request->actiontext,

       'actionurl' => $request->actionurl,

        'endpart'  => $request->endpart
     


    ];

    

     notification::send($appointment, new SendEmailNotification($details));

     return redirect()->back()->with('success','Email send successfully'); 

    }

    }
