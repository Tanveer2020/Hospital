<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
  



    public function index()
    {

    if(Auth::id()){

        return redirect('home');
    }

else
   {
        $doctors = Doctor::all();

        return view('user.home',compact('doctors'));
    }

}

    
    public function redirect(){

        if(Auth::id()){
          
          if(Auth::user()->usertype=='0')  {

             $doctors = Doctor::all();
            return view('user.home',compact('doctors'));
          }

           else{

            return view('admin.home');
           }
        }

        else{

            return redirect()->back();
        }
    }


 public function appointment(Request $request)

 {

    $appointment = Appointment::create([
      
      'name' => $request->name,
      'email'=> $request->email,
      'phone'=> $request->number,
      'doctor'=> $request->doctor,
      'date' => $request->date,
      'message'=> $request->message,
      'status'  => 'In Progress',
      'user_id' => Auth::user()->id,  

    ]);

    return redirect()->back()->with('success','Appointment Request Successfully Sent. We will contact with you soon');
 }
      

      public function myappointment(){

       if(Auth::id()){
        
          if(Auth::user()->usertype==0){

                    $userid = Auth::user()->id;

        $appoints = Appointment::where('user_id',$userid)->get();

      

        return view('user.my_appointment',compact('appoints'));

          }
        

       }

       else{
       
        return redirect()->back();

       }
       
        
      }

       public function cancel_appoint($id){
           
            $appoints = Appointment::find($id);

            $appoints->delete();

            return redirect()->back();

       }
}
