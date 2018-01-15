<?php

namespace App\Http\Controllers\Volunteer;

use App\Opportunity_member;
use App\Organization_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Opportunity;
use Auth;
use App\Opportunity_category;

class OpportunityCtrl extends Controller
{
	public function viewOpportunity(Request $request)
	{
		$oppr_types = Opportunity_category::all();
		$org_types = Organization_type::all();
		$sar_op_type = array();
		$sar_og_type = array();
		$current_loc = $this->getAddress($request);
		if($current_loc != 'error'){
			$search_addr['city'] = $current_loc['city'];
			if($current_loc['country'] == "US")
				$search_addr['state'] = $this->getAbbreviation($current_loc['region']);
			else
				$search_addr['state'] = $current_loc['region'];
			$latlng = explode(',',$current_loc['loc']);
			$search_addr['lat'] = $latlng[0];
			$search_addr['lng'] = $latlng[1];
			$today = date("Y-m-d");
			$active_oppr = Opportunity::where('state','like',$search_addr['state'])->where('city','like',$search_addr['city'])
				->where('type',1)->where('is_deleted','<>','1')->where('end_date','>=',$today)
			                          ->orderBy('created_at','desc')->get();

			$oppr_count_by_id = Opportunity::where('state','like',$search_addr['state'])->where('city','like',$search_addr['city'])
				->where('type',1)->where('is_deleted','<>','1')->where('end_date','>=',$today)
			                               ->groupBy('category_id')->selectRaw('category_id, count(*) as count')->get();

			$count_oppr = array();
			foreach ($oppr_count_by_id as $oppr_c){
				$count_oppr[$oppr_c->category_id] = $oppr_c->count;
			}
			foreach ($oppr_types as $ot){
				if(array_key_exists($ot->id,$count_oppr))
					$sar_op_type[$ot->id]['count'] = $count_oppr[$ot->id];
				else
					$sar_op_type[$ot->id]['count'] = 0;
				$sar_op_type[$ot->id]['name'] = $ot->name;
			}

			$org_count_by_id = Opportunity::where('state','like',$search_addr['state'])->where('city','like',$search_addr['state'])
				->where('type',1)->where('is_deleted','<>','1')->where('end_date','>=',$today)
			                              ->groupBy('org_type')->selectRaw('org_type, count(*) as count')->get();

			$count_org = array();
			foreach ($org_count_by_id as $org_c){
				$count_org[$org_c->org_type] = $org_c->count;
			}
			foreach ($org_types as $og){
				if(array_key_exists($og->id,$count_org))
					$sar_og_type[$og->id]['count'] = $count_org[$og->id];
				else
					$sar_og_type[$og->id]['count'] = 0;
				$sar_og_type[$og->id]['name'] = $og->organization_type;
			}
//			$circle_radius = 3959;
//			$max_distance = 20;
//			$lat = ;
//			$lng = ;
//
//            return $candidates = DB::select(
//	            'SELECT * FROM
//                    (SELECT id, name, address, phone, latitude, longitude, (' . $circle_radius . ' * acos(cos(radians(' . $lat . ')) * cos(radians(latitude)) *
//                    cos(radians(longitude) - radians(' . $lng . ')) +
//                    sin(radians(' . $lat . ')) * sin(radians(latitude))))
//                    AS distance
//                    FROM candidates) AS distances
//                WHERE distance < ' . $max_distance . '
//                ORDER BY distance
//                OFFSET 0
//                LIMIT 20;
//            ');
		}else{
			$search_addr['city'] = Auth::user()->city;
			$search_addr['state'] = Auth::user()->state;
			$search_addr['lat'] = Auth::user()->lat;
			$search_addr['lng'] = Auth::user()->lng;
			$today = date("Y-m-d");
			$active_oppr = Opportunity::where('state','like',$search_addr['state'])->where('city','like',$search_addr['city'])
				->where('type',1)->where('is_deleted','<>','1')->where('end_date','>=',$today)
			                          ->orderBy('created_at','desc')->get();

			$oppr_count_by_id = Opportunity::where('state','like',$search_addr['state'])->where('city','like',$search_addr['city'])
				->where('type',1)->where('is_deleted','<>','1')->where('end_date','>=',$today)
			                               ->groupBy('category_id')->selectRaw('category_id, count(*) as count')->get();

			$count_oppr = array();
			foreach ($oppr_count_by_id as $oppr_c){
				$count_oppr[$oppr_c->category_id] = $oppr_c->count;
			}
			foreach ($oppr_types as $ot){
				if(array_key_exists($ot->id,$count_oppr))
					$sar_op_type[$ot->id]['count'] = $count_oppr[$ot->id];
				else
					$sar_op_type[$ot->id]['count'] = 0;
				$sar_op_type[$ot->id]['name'] = $ot->name;
			}

			$org_count_by_id = Opportunity::where('state','like',$search_addr['state'])->where('city','like',$search_addr['city'])
				->where('type',1)->where('is_deleted','<>','1')->where('end_date','>=',$today)
			                              ->groupBy('org_type')->selectRaw('org_type, count(*) as count')->get();

			$count_org = array();
			foreach ($org_count_by_id as $org_c){
				$count_org[$org_c->org_type] = $org_c->count;
			}
			foreach ($org_types as $og){
				if(array_key_exists($og->id,$count_org))
					$sar_og_type[$og->id]['count'] = $count_org[$og->id];
				else
					$sar_og_type[$og->id]['count'] = 0;
				$sar_og_type[$og->id]['name'] = $og->organization_type;
			}
		}

		return view('volunteer.opportunities',
			['search_addr'=>$search_addr,'op_type'=>$sar_op_type,'og_type'=>$sar_og_type,'opprs'=>$active_oppr,'page_name'=>'vol_oppor']);
	}

	public function viewLocationOpportunity(Request $request){
		$oppr_types = Opportunity_category::all();
		$org_types = Organization_type::all();
		$location = $request->get('input_search_loc');
		$pos = explode(',',$location);
		$city = $pos[0];
		if(count($pos) > 1){
			$state = str_replace(' ','',$pos[1]);
		}else{
			$state = '';
		}
		$search_addr['city'] = $city;
		$search_addr['state'] = $state;
		$sar_op_type = array();
		$sar_og_type = array();

		$today = date("Y-m-d");
		$active_oppr = Opportunity::where('state','like',$search_addr['state'])->where('city','like',$search_addr['city'])
			->where('type',1)->where('is_deleted','<>','1')->where('end_date','>=',$today)
		                          ->orderBy('created_at','desc')->get();

		$oppr_count_by_id = Opportunity::where('state','like',$search_addr['state'])->where('city','like',$search_addr['city'])
			->where('type',1)->where('is_deleted','<>','1')->where('end_date','>=',$today)
		                               ->groupBy('category_id')->selectRaw('category_id, count(*) as count')->get();

		$count_oppr = array();
		foreach ($oppr_count_by_id as $oppr_c){
			$count_oppr[$oppr_c->category_id] = $oppr_c->count;
		}
		foreach ($oppr_types as $ot){
			if(array_key_exists($ot->id,$count_oppr))
				$sar_op_type[$ot->id]['count'] = $count_oppr[$ot->id];
			else
				$sar_op_type[$ot->id]['count'] = 0;
			$sar_op_type[$ot->id]['name'] = $ot->name;
		}

		$org_count_by_id = Opportunity::where('state','like',$state)->where('city','like',$city)
			->where('type',1)->where('is_deleted','<>','1')->where('end_date','>=',$today)
		                              ->groupBy('org_type')->selectRaw('org_type, count(*) as count')->get();

		$count_org = array();
		foreach ($org_count_by_id as $org_c){
			$count_org[$org_c->org_type] = $org_c->count;
		}
		foreach ($org_types as $og){
			if(array_key_exists($og->id,$count_org))
				$sar_og_type[$og->id]['count'] = $count_org[$og->id];
			else
				$sar_og_type[$og->id]['count'] = 0;
			$sar_og_type[$og->id]['name'] = $og->organization_type;
		}

		if($active_oppr->count()){
			$search_addr['lat'] = $active_oppr->first()->lat;
			$search_addr['lng'] = $active_oppr->first()->lng;
		}else{
			$search_addr['lat'] = Auth::user()->lat;
			$search_addr['lng'] = Auth::user()->lng;
		}

		return view('volunteer.opportunities',
			['search_addr'=>$search_addr,'op_type'=>$sar_op_type,'og_type'=>$sar_og_type,'opprs'=>$active_oppr,'page_name'=>'vol_oppor']);
	}
	
	public function getSearchResult(Request $request){
		$start_date = date("Y-m-d", strtotime($request->input('start_date')));
		$end_date = date("Y-m-d", strtotime($request->input('end_date')));
		$location = $request->input('location');
		$oppor_types = $request->input('opp_types');
		$org_types = $request->input('org_types');
		$keyword = $request->input('keyword');
		$today = date("Y-m-d");
		if($start_date == '1970-01-01'){
			$start_date = '1999-01-01';
		}
		if($end_date == '1970-01-01'){
			$end_date = '2999-12-31';
		}
		$pos = explode(',',$location);
		$city = $pos[0];
		$state = str_replace(' ','',$pos[1]);
		$search_addr['city'] = $city;
		$search_addr['state'] = $state;

		if($oppor_types != ''){
			if($org_types != ''){
				$active_oppr = Opportunity::where('state','like',$state)->where('city','like',$city)->where('type',1)
					->where('is_deleted','<>','1')->where('end_date','>=',$today)->whereBetween('start_date',array($start_date,$end_date))
					->whereIn('org_type',$org_types)->whereIn('category_id',$oppor_types)
					->where(function ($query) use ($keyword) {
						$query->where("title", "LIKE","%$keyword%")
						      ->orWhere("description", "LIKE", "%$keyword%")
						      ->orWhere("activity", "LIKE", "%$keyword%");
					})
					->orderBy('created_at','desc')->get();
			}else{
				$active_oppr = Opportunity::where('state','like',$state)->where('city','like',$city)->where('end_date','>=',$today)->where('type',1)
				    ->where('is_deleted','<>','1')->whereBetween('start_date',array($start_date,$end_date))->whereIn('category_id',$oppor_types)
					->where(function ($query) use ($keyword) {
						$query->where("title", "LIKE","%$keyword%")
						      ->orWhere("description", "LIKE", "%$keyword%")
						      ->orWhere("activity", "LIKE", "%$keyword%");
					})
					->orderBy('created_at','desc')->get();
			}
		}else{
			if($org_types != ''){
				$active_oppr = Opportunity::where('state','like',$state)->where('city','like',$city)->where('end_date','>=',$today)->where('type',1)
					->where('is_deleted','<>','1')->whereBetween('start_date',array($start_date,$end_date))->whereIn('org_type',$org_types)
					->where(function ($query) use ($keyword) {
						$query->where("title", "LIKE","%$keyword%")
						      ->orWhere("description", "LIKE", "%$keyword%")
						      ->orWhere("activity", "LIKE", "%$keyword%");
					})
					->orderBy('created_at','desc')->get();
			}else{
				$active_oppr = Opportunity::where('state','like',$state)->where('city','like',$city)->where('end_date','>=',$today)->where('type',1)
				    ->where('is_deleted','<>','1')->whereBetween('start_date',array($start_date,$end_date))
					->where(function ($query) use ($keyword) {
						$query->where("title", "LIKE","%$keyword%")
						      ->orWhere("description", "LIKE", "%$keyword%")
						      ->orWhere("activity", "LIKE", "%$keyword%");
					})
				    ->orderBy('created_at','desc')->get();
			}
		}
		if($active_oppr->count()){
			$search_addr['lat'] = $active_oppr->first()->lat;
			$search_addr['lng'] = $active_oppr->first()->lng;
		}else{
			$search_addr['lat'] = Auth::user()->lat;
			$search_addr['lng'] = Auth::user()->lng;
		}

		return Response::json(['search_addr'=>$search_addr,'opprs'=>$active_oppr]);

//		return Response::json(['result'=>'success']);
	}

	public function viewOpportunityPage($id)
	{
		$oppr = Opportunity::find($id);
		if($oppr->type == Opportunity::REGULAR_OPPORTUNITY){
			$is_member = 0;
			if(Opportunity_member::where('oppor_id',$id)->where('user_id',Auth::user()->id)->count()>0)
				$is_member = 1;
			return view('volunteer.viewOpportunity',['oppr_info'=>$oppr,'is_member'=>$is_member,'page_name'=>'']);
		}else{
			return redirect()->to('/');
		}
	}

	public function joinOpportunity(Request $request)
	{
		$user_id = $request->input('user_id');
		$oppor_id = $request->input('oppor_id');
		$oppor_member = new Opportunity_member;
		$oppor_member->oppor_id = $oppor_id;
		$oppor_member->user_id = $user_id;
		$oppor_member->org_id = Opportunity::find($oppor_id)->org_id;
		$oppor_member->save();

		return Response::json(['result'=>'success']);
	}

	public function findOnMap(Request $request){
		$id = $request->input('opportunity_id');
		$result = Opportunity::find($id);
		return Response::json(['result'=>$result]);
	}

	public function getAddress(Request $request){
		$ip = $request->ip();
		$details = json_decode(file_get_contents("http://ipinfo.io/".$ip."/json"),true);
		if(isset($details['loc'])){
			return $details;
		}else{
			return 'error';
		}
	}

	public function getAbbreviation($name)
	{
		$states = array(
			'Alabama'=>'AL',
			'Alaska'=>'AK',
			'Arizona'=>'AZ',
			'Arkansas'=>'AR',
			'California'=>'CA',
			'Colorado'=>'CO',
			'Connecticut'=>'CT',
			'Delaware'=>'DE',
			'Florida'=>'FL',
			'Georgia'=>'GA',
			'Hawaii'=>'HI',
			'Idaho'=>'ID',
			'Illinois'=>'IL',
			'Indiana'=>'IN',
			'Iowa'=>'IA',
			'Kansas'=>'KS',
			'Kentucky'=>'KY',
			'Louisiana'=>'LA',
			'Maine'=>'ME',
			'Maryland'=>'MD',
			'Massachusetts'=>'MA',
			'Michigan'=>'MI',
			'Minnesota'=>'MN',
			'Mississippi'=>'MS',
			'Missouri'=>'MO',
			'Montana'=>'MT',
			'Nebraska'=>'NE',
			'Nevada'=>'NV',
			'New Hampshire'=>'NH',
			'New Jersey'=>'NJ',
			'New Mexico'=>'NM',
			'New York'=>'NY',
			'North Carolina'=>'NC',
			'North Dakota'=>'ND',
			'Ohio'=>'OH',
			'Oklahoma'=>'OK',
			'Oregon'=>'OR',
			'Pennsylvania'=>'PA',
			'Rhode Island'=>'RI',
			'South Carolina'=>'SC',
			'South Dakota'=>'SD',
			'Tennessee'=>'TN',
			'Texas'=>'TX',
			'Utah'=>'UT',
			'Vermont'=>'VT',
			'Virginia'=>'VA',
			'Washington'=>'WA',
			'West Virginia'=>'WV',
			'Wisconsin'=>'WI',
			'Wyoming'=>'WY'
		);
		return $states[$name];
	}

}
