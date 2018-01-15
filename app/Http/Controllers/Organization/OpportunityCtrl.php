<?php

namespace App\Http\Controllers\Organization;

use App\Opportunity;
use App\Opportunity_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Auth;
use App\Http\Controllers\Controller;
use App\News;

class OpportunityCtrl extends Controller
{
	public function viewPostingPage()
	{
		return view('organization.post_opportunity',['user_info'=>Auth::user(),'opportunity_category'=>Opportunity_category::all(),'page_name'=>'']);
	}

	public function viewUpdatingPage($id=null)
	{
		if($id != null){
			$exist_oppr = Opportunity::find($id);
			return view('organization.update_opportunity',['oppr_info'=>$exist_oppr,'opportunity_category'=>Opportunity_category::all(),'user_info'=>Auth::user(),'page_name'=>'']);
		}else{
			return view('organization.post_opportunity',['user_info'=>Auth::user(),'opportunity_category'=>Opportunity_category::all(),'page_name'=>'']);
		}
	}

	public function viewManageOpportunity()
	{
		$today = date("Y-m-d");
		$active_oppr = Opportunity::where('org_id',Auth::user()->id)->where('type',1)->where('is_deleted','<>',1)->where('end_date','>=',$today)->orderBy('created_at','desc')->get();
		$expired_oppr = Opportunity::where('org_id',Auth::user()->id)->where('type',1)->where('is_deleted','<>',1)->where('end_date','<',$today)->orderBy('created_at','desc')->get();
		return view('organization.opportunity',['active_oppors'=>$active_oppr,'expired_oppors'=>$expired_oppr,'user_info'=>Auth::user(),'page_name'=>'org_oppor']);
	}

	public function viewOpportunity($id)
	{
		$oppr = Opportunity::find($id);
		return view('organization.viewOpportunity',['oppr_info'=>$oppr,'user_info'=>Auth::user(),'page_name'=>'']);
	}

	public function postOpportunity(Request $request){
		$opportunity = new Opportunity;
		$opportunity->org_id = Auth::user()->id;
		$opportunity->org_type = Auth::user()->org_type;
		$opportunity->title = $request->get('title');
		$opportunity->category_id = $request->get('opportunity_type');
		$opportunity->description = $request->get('description');
		$opportunity->min_age = $request->get('min_age');
		$opportunity->activity = $request->get('activity');
		$opportunity->qualification = $request->get('qualification');
		$opportunity->street_addr1 = $request->get('street1');
		$opportunity->street_addr2 = $request->get('street2');
		$opportunity->city = $request->get('city');
		$opportunity->state = $request->get('state');
		$opportunity->zipcode = $request->get('zipcode');
		$opportunity->additional_info = $request->get('add_info');
		$opportunity->start_date = date("Y-m-d", strtotime($request->get('start_date')));
		$opportunity->end_date = date("Y-m-d", strtotime($request->get('end_date')));
		$opportunity->start_at = $request->get('start_at');
		$opportunity->end_at = $request->get('end_at');
//		$opportunity->weekdays = $request->get('weekday_vals');
		$opportunity->contact_name = $request->get('contact_name');
		$opportunity->contact_email = $request->get('contact_email');
		$opportunity->contact_number = $request->get('contact_phone');
		$opportunity->is_deleted = 0;
		$location = $this->getLocation($request->get('street1').', '.$request->get('city').', '.$request->get('state'));
		if($location!='error'){
			$opportunity->lat = $location['lat'];
			$opportunity->lng = $location['lng'];
		}

		if($request->hasFile('file_logo')) {
			$file = $request->file('file_logo');
			$name = time().$file->getClientOriginalName();

			//using array instead of object
			$image['filePath'] = $name;
			$file->move(public_path().'/uploads/', $name);
			$opportunity->logo_img = $name;
		}
		$weekdays = array();
		if($request->get('monday')=='on'){
			array_push($weekdays,"Monday");
		}
		if($request->get('tuesday')=='on'){
			array_push($weekdays,"Tuesday");
		}
		if($request->get('wednesday')=='on'){
			array_push($weekdays,"Wednesday");
		}
		if($request->get('thursday')=='on'){
			array_push($weekdays,"Thursday");
		}
		if($request->get('friday')=='on'){
			array_push($weekdays,"Friday");
		}
		if($request->get('saturday')=='on'){
			array_push($weekdays,"Saturday");
		}
		if($request->get('sunday')=='on'){
			array_push($weekdays,"Sunday");
		}
		$days = implode(",",$weekdays);
		$opportunity->weekdays = $days;
		$opportunity->save();

//		$news = new News;
//		$news->user_id = Auth::user()->id;
//		$news->news_type = News::POSTED_NEWS;
//		$news->title = 'New Opportunity Posted!';
//		$news->save();
		return redirect()->to('/organization/view_opportunity/'.$opportunity->id);
	}

	public function updateOpportunity(Request $request,$id){
		$opportunity = Opportunity::find($id);
		$opportunity->title = $request->get('title');
		$opportunity->category_id = $request->get('opportunity_type');
		$opportunity->description = $request->get('description');
		$opportunity->min_age = $request->get('min_age');
		$opportunity->activity = $request->get('activity');
		$opportunity->qualification = $request->get('qualification');
		$opportunity->street_addr1 = $request->get('street1');
		$opportunity->street_addr2 = $request->get('street2');
		$opportunity->city = $request->get('city');
		$opportunity->state = $request->get('state');
		$opportunity->zipcode = $request->get('zipcode');
		$opportunity->additional_info = $request->get('add_info');
		$opportunity->start_date = date("Y-m-d", strtotime($request->get('start_date')));
		$opportunity->end_date = date("Y-m-d", strtotime($request->get('end_date')));
		$opportunity->start_at = $request->get('start_at');
		$opportunity->end_at = $request->get('end_at');
		$opportunity->weekdays = $request->get('weekday_vals');
		$opportunity->contact_name = $request->get('contact_name');
		$opportunity->contact_email = $request->get('contact_email');
		$opportunity->contact_number = $request->get('contact_phone');

		$location = $this->getLocation($request->get('street1').', '.$request->get('city').', '.$request->get('state'));
		if($location!='error'){
			$opportunity->lat = $location['lat'];
			$opportunity->lng = $location['lng'];
		}
		if($request->hasFile('file_logo')) {
			$file = $request->file('file_logo');
			$name = time().$file->getClientOriginalName();

			//using array instead of object
			$image['filePath'] = $name;
			$file->move(public_path().'/uploads/', $name);
			$opportunity->logo_img = $name;
		}
		$opportunity->save();
		return redirect()->to('/organization/view_opportunity/'.$id);
	}

	public function deleteOpportunity(Request $request){
		$id = $request->input('oppr_id');
		$opportunity = Opportunity::find($id);
		$opportunity->is_deleted = 1;
		$opportunity->save();
		return Response::json(['result'=>$id]);
	}

	public function getLocation($address){
		/*get location from address*/
		$address = str_replace(' ','+',$address);
		$url ="https://maps.googleapis.com/maps/api/geocode/json?address=".$address."&key=AIzaSyA3n1_WGs2PVEv2JqsmxeEsgvrorUiI5Es";
		$result = json_decode(file_get_contents($url),true);
		if($result['results']==[]){
			return 'error';
		}else
			return $result['results'][0]['geometry']['location'];
	}
}
