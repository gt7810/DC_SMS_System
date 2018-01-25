<?php

class Group {
	// Use mysql2 for database connection
	public static function selectGroup($group_name,$yeargroup){

		switch ($group_name) {
		    case 'staff':
		        $query = "SELECT sf.sfkey as id, concat(sf.pref_name,' ',sf.surname) as name, concat('852', sf.mobile) AS mobile
						FROM sf
						WHERE sf.mobile IS NOT null AND sf.staff_type IN ('T','N')";
				$staffs = DB::connection('mysql2')->select($query);
				$result = array();
				
				foreach($staffs as $staff) {
					if(!empty($staff->mobile)){
						$result[] = array('id' => $staff->id,'name' => $staff->name,'mobile' => str_replace(' ', '', $staff->mobile));
					}
				}

				return json_decode (json_encode ($result ), FALSE);
		        break;
		    case 'all-parents':
				$query = 	"SELECT
							  df.fmobile_cc,df.fmobile,df.fname,df.mmobile,df.mmobile_cc,df.mname,df.surname,df.dfkey,st.first_name,st.status,
							  GROUP_CONCAT('- ',st.first_name, ' ',st.school_year) AS 'students'
							FROM
							  df,st
							WHERE
							  df.dfkey = st.family AND st.status = 'FULL'
							GROUP BY
							  df.dfkey";

				$parents = DB::connection('mysql2')->select($query);
				$result = array();
				
				foreach($parents as $parent) {
					if(!empty($parent->mmobile)){
						$result[] = array('id' => $parent->dfkey,'name' => $parent->mname.' '.$parent->surname.' '.$parent->students,'mobile' => str_replace(' ', '', $parent->mmobile_cc.$parent->mmobile));
					}
					if(!empty($parent->fmobile)){
						$result[] = array('id' => $parent->dfkey,'name' => $parent->fname.' '.$parent->surname.' '.$parent->students,'mobile' => str_replace(' ', '', $parent->fmobile_cc.$parent->fmobile));
					}
				}

				return json_decode (json_encode ($result ), FALSE);
		        break;
		    case 'primary':
		        $query = 	"SELECT
							  df.fmobile_cc,df.fmobile,df.fname,df.mmobile,df.mmobile_cc,df.mname,df.surname,df.dfkey,st.first_name,st.status,
							  GROUP_CONCAT('- ',st.first_name, ' ',st.school_year) AS 'students'
							FROM
							  df,st
							WHERE
								df.dfkey = st.family AND st.status = 'full' AND st.school_year <'Y07'
							group by st.family order by st.school_year, st.roll_group, st.family";

				$parents = DB::connection('mysql2')->select($query);
				$result = array();
				
				foreach($parents as $parent) {
					if(!empty($parent->mmobile)){
						$result[] = array('id' => $parent->dfkey,'name' => $parent->mname.' '.$parent->surname.' '.$parent->students,'mobile' => str_replace(' ', '', $parent->mmobile_cc.$parent->mmobile));
					}
					if(!empty($parent->fmobile)){
						$result[] = array('id' => $parent->dfkey,'name' => $parent->fname.' '.$parent->surname.' '.$parent->students,'mobile' => str_replace(' ', '', $parent->fmobile_cc.$parent->fmobile));
					}
				}

				return json_decode (json_encode ($result ), FALSE);
		        break;
		    case 'secondary':
		        $query = 	"SELECT
							  df.fmobile_cc,df.fmobile,df.fname,df.mmobile,df.mmobile_cc,df.mname,df.surname,df.dfkey,st.first_name,st.status,
							  GROUP_CONCAT('- ',st.first_name, ' ',st.school_year) AS 'students'
							FROM
							  df,st
							WHERE
								df.dfkey = st.family AND st.status = 'full' AND st.school_year >'Y06'
							group by st.family order by st.school_year, st.roll_group, st.family";

				$parents = DB::connection('mysql2')->select($query);
				$result = array();
				
				foreach($parents as $parent) {
					if(!empty($parent->mmobile)){
						$result[] = array('id' => $parent->dfkey,'name' => $parent->mname.' '.$parent->surname.' '.$parent->students,'mobile' => str_replace(' ', '', $parent->mmobile_cc.$parent->mmobile));
					}
					if(!empty($parent->fmobile)){
						$result[] = array('id' => $parent->dfkey,'name' => $parent->fname.' '.$parent->surname.' '.$parent->students,'mobile' => str_replace(' ', '', $parent->fmobile_cc.$parent->fmobile));
					}
				}

				return json_decode (json_encode ($result ), FALSE);
		        break;
		    case 'year-group':
		    	$yeargroup = str_replace(",", "','", $yeargroup);
		    	$yeargroup = "'".$yeargroup."'";
		        $query = 	"SELECT
							  df.fmobile_cc,df.fmobile,df.fname,df.mmobile,df.mmobile_cc,df.mname,df.surname,df.dfkey,st.first_name,st.status,
							  GROUP_CONCAT('- ',st.first_name, ' ',st.school_year) AS 'students'
							FROM
							  df,st
							WHERE
								df.dfkey = st.family AND st.status = 'full' AND st.school_year IN ($yeargroup)
							group by st.family order by st.school_year, st.roll_group, st.family";

				$parents = DB::connection('mysql2')->select($query);
				$result = array();
				
				foreach($parents as $parent) {
					if(!empty($parent->mmobile)){
						$result[] = array('id' => $parent->dfkey,'name' => $parent->mname.' '.$parent->surname.' '.$parent->students,'mobile' => str_replace(' ', '', $parent->mmobile_cc.$parent->mmobile));
					}
					if(!empty($parent->fmobile)){
						$result[] = array('id' => $parent->dfkey,'name' => $parent->fname.' '.$parent->surname.' '.$parent->students,'mobile' => str_replace(' ', '', $parent->fmobile_cc.$parent->fmobile));
					}
				}

				return json_decode (json_encode ($result ), FALSE);
				break;
		    case 'test':
		        $result = array(
							array('id'=>'t1','name' => 'Test User: Pete Stewart','mobile' => str_replace(' ', '', '852 5335 9049')),
							array('id'=>'t2','name' => 'Test User Error','mobile' => str_replace(' ', '', 'abc ded')),
						);
		        return json_decode (json_encode ($result ), FALSE);
		        break;
		}
	}
}
