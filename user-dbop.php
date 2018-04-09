<?php

if (!isset($_SESSION))
    session_start();
include_once 'dbconnect.php';

class User {

    var $dbObj;

    public function __construct() {
        $this->dbObj = new db();
    }

    public function insert($user_name, $password, $name, $address, $contact_no, $about) {
        $password = hash('sha256', $password);
        $sql = " INSERT INTO user"
                . " (user_name,password,name,address,contact_no,about)"
                . " VALUES('$user_name','$password','$name','$address','$contact_no','$about')";
        return $this->dbObj->ExecuteQuery($sql, 2);
    }

   public function  reg($email_id,$password,$reg_as)
   {
    $sql = "INSERT INTO register( email_id,password,reg_as) VALUES
		('$email_id', '$password','$reg_as')";
    return $this->dbObj->ExecuteQuery($sql, 2);

   }
  
    public function  reg_d($reg_no,$email_id)
   {
    $sql = "INSERT INTO donor( reg_no,email_id) VALUES
		('$reg_no','$email_id')";
    return $this->dbObj->ExecuteQuery($sql, 2);

   }
   
    public function  reg_v($reg_no,$email_id)
   {
    $sql = "INSERT INTO vendor( reg_no,email_id) VALUES
		('$reg_no','$email_id')";
    return $this->dbObj->ExecuteQuery($sql, 2);

   }
   
   public function  trans_d($req_id,$regs,$regd,$status)
   {
     if($status=='WAITING')
	 {
	$sql="insert into donor_trans(req_id,regs,regd,status,open_date) values('$req_id','$regs','$regd','$status',now())";
    return $this->dbObj->ExecuteQuery($sql, 2); 
		 
	 }
	$sql="update req set visibility='not visible' where id='$req_id'";
	$this->dbObj->ExecuteQuery($sql, 2);
   $sql="insert into donor_trans(req_id,regs,regd,status,open_date) values('$req_id','$regs','$regd','$status',now())";
    return $this->dbObj->ExecuteQuery($sql, 2);
   }
   
   public function  trans_v($trans_id,$reg_no,$dregno)
   {
	   
     $sql="insert into vendor_trans(trans_id,reg_no,dreg_no,status) values('$trans_id','$reg_no','$dregno','READY')";
    return $this->dbObj->ExecuteQuery($sql, 2);
   }
   
   public function  trans_ok($trans_id,$vtrans_id,$status)
   {
	   $sql="update vendor_trans v set status='$status' where vtrans_id='$vtrans_id'  ";
    return $this->dbObj->ExecuteQuery($sql, 3);
   }
   
   
   
   public function  trans_update($trans_id,$status)
   {
	   if($status==0)
		   $st="NOT RECIEVED";
	   if($status==1)
		   $st="CLOSED";
	   
	   
	$sql="update donor_trans set status='$st' where trans_id='$trans_id'";
    return $this->dbObj->ExecuteQuery($sql, 3);
   }
   
   
       public function select_ser()
	   {
		  $sql="select * from ser_type";
		 return $this->dbObj->ExecuteQuery($sql, 1);
 
	   }
	   
	   public function select_loc()
	   {
		  $sql="select distinct location from req";
		 return $this->dbObj->ExecuteQuery($sql, 1);
 
	   }
	   
	   
	   public function select_type()
	   {
		  $sql="select distinct type from seeker";
		 return $this->dbObj->ExecuteQuery($sql, 1);
 
	   }
	   
	   public function select_name()
	   {
		  $sql="select distinct org_name from seeker";
		 return $this->dbObj->ExecuteQuery($sql, 1);
 
	   }
	   
	   
   
   
   
      public function  trans_update_donor($trans_id,$status,$reg_no)
   {
	   
	    
		   $st="IN PROGRESS";
	$sql="update donor_trans set status='IN PROGRESS',regv='$reg_no' where trans_id='$trans_id'";
    return $this->dbObj->ExecuteQuery($sql, 3);
	  
	
   }
   
   
   public function profile_d($reg_no,$org_name,$cont,$addr,$gst,$website,$type,$info,$caption)
   {
	  $sql="UPDATE donor  SET org_name = '$org_name',cont='$cont',gst='$gst',type='$type',info='$info',caption='$caption',website='$website',addr='$addr' WHERE reg_no = '$reg_no'"; 
	   $this->dbObj->ExecuteQuery($sql, 2);
	   
   }
   
    public function profile_s($reg_no,$org_name,$cont,$addr,$lic_no,$website,$type,$info,$caption)
   {
	  $sql="UPDATE seeker  SET org_name = '$org_name',cont='$cont',lic_no='$lic_no',type='$type',info='$info',caption='$caption',website='$website',addr='$addr' WHERE reg_no = '$reg_no'"; 
	   $this->dbObj->ExecuteQuery($sql, 2);
	   
   }
   public function profile_v($reg_no,$org_name,$cont,$addr,$lic_no,$website,$ser_type,$info,$caption)
   {
	  $sql="UPDATE vendor  SET org_name = '$org_name',cont='$cont',lic_no='$lic_no',ser_type='$ser_type',info='$info',caption='$caption',website='$website',addr='$addr' WHERE reg_no = '$reg_no'"; 
	   $this->dbObj->ExecuteQuery($sql, 2);
	   
   }
   
   public function  reg_s($reg_no,$email_id)
   {
    $sql = "INSERT INTO seeker( reg_no,email_id) VALUES
		('$reg_no','$email_id')";
    return $this->dbObj->ExecuteQuery($sql, 2);

   }
   
   public function  request($reg_no,$email_id,$ser_type,$location,$brief,$detailed)
   {
    
		
	$sql = "INSERT INTO req (reg_no,email_id,ser_type,location,date_req,brief,detailed) VALUES ('$reg_no','$email_id','$ser_type', '$location',now(),'$brief','$detailed')";
    return $this->dbObj->ExecuteQuery($sql, 2);

   }
   
   

    public function update($user_name, $password, $name, $address, $contact_no, $about, $old_password, $user_id) {
        if (empty($password))
            $password = $old_password;
        else
            $password = hash('sha256', $password);
        $sql = " UPDATE"
                . " user "
                . " SET user_name = '$user_name',password = '$password',name = '$name',address = '$address',"
                . " contact_no = '$contact_no',about = '$about'"
                . " WHERE user_id = '$user_id'";
        return $this->dbObj->ExecuteQuery($sql, 3);
    }

    public function select_by_id($user_id) {
        $sql = " SELECT"
                . " user_id,user_name,password,name,address,contact_no,about"
                . " FROM user WHERE user_id = '$user_id'";
        return $this->dbObj->ExecuteQuery($sql, 1);
    }
	
	 public function activity_log($reg_no) {
        $sql = "select t.trans_id,t.req_id,s.org_name,r.location,s.type,r.ser_type,t.open_date,t.status from seeker s,req r,donor_trans t where s.reg_no=t.regs and r.id=t.req_id and( t.status='IN PROGRESS' OR t.status='WAITING')  and regd='$reg_no'";
        return $this->dbObj->ExecuteQuery($sql, 1);
    }
	
	public function notify($reg_no) {
		
		$sql="select n.vtrans_id,r.id,n.trans_id,v.org_name,r.brief,n.reg_no from vendor v,req r,vendor_trans n,donor_trans d where v.reg_no=n.reg_no and n.dreg_no='$reg_no' and r.id=d.req_id and d.trans_id=n.trans_id and n.status='READY'";
        return $this->dbObj->ExecuteQuery($sql, 1);
    }
	
	
	
	
	public function activity_log_seeker($reg_no) {
		$sql= "select t.trans_id,t.req_id,d.org_name,r.ser_type,t.open_date,t.status from req r,donor_trans t,donor d,seeker s where 
         s.reg_no=t.regs and r.id=t.req_id and d.reg_no=t.regd and s.reg_no='$reg_no' and status='IN PROGRESS' group by t.trans_id ";
        return $this->dbObj->ExecuteQuery($sql, 1);
    }
	
	/*public function activity_log_seeker($reg_no) {
		$sql= "select t.trans_id,t.req_id,d.org_name,r.ser_type,t.open_date,t.status,v.org_name as vendor_name from req r,donor_trans t,donor d,vendor v,seeker s where 
         s.reg_no=t.regs and v.reg_no=t.regv and r.id=t.req_id  and s.reg_no='$reg_no' group by t.trans_id ";
        return $this->dbObj->ExecuteQuery($sql, 1);
    } */
	
	public function activity_logv($reg_no) {
        $sql = "select t.trans_id,t.req_id,d.org_name as d_org_name,s.org_name,r.location,s.type,r.ser_type,t.open_date,t.status from donor d,seeker s,req r,donor_trans t,vendor v where s.reg_no=t.regs and r.id=t.req_id and status='WAITING' and r.ser_type=v.ser_type and v.reg_no='$reg_no' and d.reg_no=t.regd ";
        return $this->dbObj->ExecuteQuery($sql, 1);
    }
	
	public function history_seeker($reg_no) {
		$sql = "select r.id,r.brief,r.location,r.ser_type,r.date_req from req r where  r.reg_no='$reg_no' ";
        return $this->dbObj->ExecuteQuery($sql, 1);
    }
	
	public function history($reg_no) {
        $sql = "select t.trans_id,t.req_id,s.org_name,r.location,s.type,r.ser_type,t.open_date,t.status from seeker s,req r,donor_trans t,donor d where s.reg_no=t.regs and r.id=t.req_id and t.status IN('CLOSED','WITHDRAW','NOT RECEIVED') and t.regd=d.reg_no and t.regd='$reg_no' ";
        return $this->dbObj->ExecuteQuery($sql, 1);
    }

	public function historyv($reg_no) {
      $sql=" select t.trans_id,t.req_id,d.org_name as d_org_name,s.org_name,r.location,s.type,r.ser_type,t.open_date,n.status from donor d,seeker s,req r,donor_trans t,vendor_trans n,vendor v where d.reg_no=t.regd and s.reg_no=t.regs and r.id=t.req_id and  t.trans_id=n.trans_id and v.reg_no=t.regv and n.status IN('READY','ACCEPT','REJECT') and t.regv='$reg_no'";       
        return $this->dbObj->ExecuteQuery($sql, 1);
    }
	
		/*public function select_by_regnod($reg_no) {
		
				
        $sql = " SELECT"
                . " *"
                . " FROM donor WHERE reg_no = '$reg_no'";
              $data=$this->dbObj->ExecuteQuery($sql, 1);
		       $fetch_data = mysqli_fetch_assoc($data);
                return $fetch_data;
	   	
    } */
	public function log2($reg_no) {
		
		
        
       $sql = " SELECT"
                . " *"
                . " FROM donor d,seeker s,vendor v WHERE"
                . " s.reg_no = '$reg_no' or d.reg_no = '$reg_no' or v.reg_no = '$reg_no' " ;
        $data = $this->dbObj->ExecuteQuery($sql, 1);
       $fetch_data = mysqli_fetch_assoc($data);
       return $fetch_data;
    }
	
	
	public function log_s($reg_no) {
		
		
        
       $sql = " SELECT"
                . " *"
                . " FROM seeker s WHERE"
                . " s.reg_no = '$reg_no' " ;
        $data = $this->dbObj->ExecuteQuery($sql, 1);
       $fetch_data = mysqli_fetch_assoc($data);
       return $fetch_data;
    }
	
  /*public function report($reg_no,$no)
	{
		
		if($no==1)
		{
		$sql = " SELECT"
                . " count(trans_id) as progress"
                . " FROM donor_trans"
                . " where regd = '$reg_no' and status='IN PROGRESS' " ;
				
        $data = $this->dbObj->ExecuteQuery($sql, 1);
		return $data;
		}
		if($no==2)
		{
		$sql = " SELECT"
                . " count(trans_id) as closed"
                . " FROM donor_trans"
                . "where regd = '$reg_no' and status='CLOSED' " ;
	    $data = $this->dbObj->ExecuteQuery($sql, 1);
		return $data;
		}
		 if($no==3)
		 {
		$sql = " SELECT"
                . " count(trans_id) as withdrawn"
                . " FROM donor_trans"
                . "where regd = '$reg_no' and status='WITHDRAWN' " ;
        $data = $this->dbObj->ExecuteQuery($sql, 1);
		 return $data;
		 }
		if($no==4)
		{
	   $sql = " SELECT"
                . " count(trans_id) as waiting"
                . " FROM donor_trans"
                . " where regd = '$reg_no' and status='WAITING' " ;
        $data = $this->dbObj->ExecuteQuery($sql, 1);
		return $data;
		}		
		
	}   */
	
	
	
	public function logd($reg_no) {
		
		
        
       $sql = " SELECT"
                . " *"
                . " FROM donor  WHERE"
                . "  reg_no = '$reg_no' " ;
        $data = $this->dbObj->ExecuteQuery($sql, 1);
       $fetch_data = mysqli_fetch_assoc($data);
       return $fetch_data;
    }
	
	public function logv($reg_no) {
		
		
        
       $sql = " SELECT"
                . " *"
                . " FROM vendor  WHERE"
                . "  reg_no = '$reg_no' " ;
        $data = $this->dbObj->ExecuteQuery($sql, 1);
       $fetch_data = mysqli_fetch_assoc($data);
       return $fetch_data;
    }
	
	public function details($id) {
		
		
        
       $sql = " SELECT"
                . " *"
                . " FROM req r,seeker s  WHERE"
                . "  r.id = '$id'and r.reg_no=s.reg_no " ;
        $data = $this->dbObj->ExecuteQuery($sql, 1);
       $fetch_data = mysqli_fetch_assoc($data);
       return $fetch_data;
    }
	
	public function details_v($id) {
		
		
        
       $sql = " SELECT"
                . " *"
                . " FROM req r,vendor s  WHERE"
                . "  r.id = '$id'  " ;
        $data = $this->dbObj->ExecuteQuery($sql, 1);
       $fetch_data = mysqli_fetch_assoc($data);
       return $fetch_data;
    }
	
	public function details_vndr($id,$dno) {
		
		
        
       $sql = " SELECT"
                . " *"
                . " FROM req r,vendor s  WHERE"
                . "  r.id = '$id' and s.reg_no='$dno' " ;
        $data = $this->dbObj->ExecuteQuery($sql, 1);
       $fetch_data = mysqli_fetch_assoc($data);
       return $fetch_data;
    }
	
	public function details_d($id) {
		
		
        
       $sql = " SELECT"
                . " *"
                . " FROM req r,donor d,donor_trans t  WHERE"
                . "  t.regd= d.reg_no and t.trans_id='$id' and r.id=t.req_id" ;
        $data = $this->dbObj->ExecuteQuery($sql, 1);
       $fetch_data = mysqli_fetch_assoc($data);
       return $fetch_data;
    }
	
	public function details_type($id) {
		
		
        
       $sql = " SELECT"
                . " r.ser_type"
                . " FROM req r  WHERE"
                . "  r.id = '$id' " ;
        $data = $this->dbObj->ExecuteQuery($sql, 1);
       $fetch_data = mysqli_fetch_assoc($data);
       return $fetch_data;
    }
	
	
		
	
	public function trans_details($id) {
		
		
        
       $sql = " SELECT"
                . " *"
                . " donor_trans d  WHERE"
                . "  r.trans_id = '$id' " ;
        $data = $this->dbObj->ExecuteQuery($sql, 1);
       $fetch_data = mysqli_fetch_assoc($data);
       return $fetch_data;
    }
	
	
	
	
	
	
	public function searchl($value,$parameter) {
        if($parameter==1)
       $sql = "select r.id,r.brief,s.org_name,r.location,s.type,r.ser_type,r.date_req from req r,seeker s where r.location='$value'  and r.reg_no=s.reg_no and visibility='visible'";
         if($parameter==2)
	   $sql = "select r.id,r.brief,s.org_name,r.location,s.type,r.ser_type,r.date_req from req r,seeker s where s.type='$value'  and r.reg_no=s.reg_no and visibility='visible'";
        if($parameter==3)
	   $sql = "select r.id,r.brief,s.org_name,r.location,s.type,r.ser_type,r.date_req from req r,seeker s where r.ser_type='$value'  and r.reg_no=s.reg_no and visibility='visible'";
        if($parameter==4)
	  $sql = "select r.id,r.brief,s.org_name,r.location,s.type,r.ser_type,r.date_req from req r,seeker s where s.org_name='$value'  and r.reg_no=s.reg_no and visibility='visible'";


        $data = $this->dbObj->ExecuteQuery($sql, 1);
       
       return $data;
    }
	
	
	
	
	
	public function display() {
        
	  $sql = "select r.id,r.brief,s.org_name,r.location,s.type,r.ser_type,r.date_req from req r,seeker s where r.reg_no=s.reg_no and r.visibility='visible'";


        $data = $this->dbObj->ExecuteQuery($sql, 1);
       
       return $data;
    }
	
	public function display_vendor() {
        
	  $sql = "select r.id,r.brief,s.org_name,r.location,s.type,r.ser_type,r.date_req from req r,seeker s where r.reg_no=s.reg_no and r.visibility='visible'";


        $data = $this->dbObj->ExecuteQuery($sql, 1);
       
       return $data;
    }
	
	
	
	

	
	
	
    public function delete_account($user_id) {
        $sql = " DELETE FROM user WHERE user_id = '$user_id'";
        return $this->dbObj->ExecuteQuery($sql, 3);
    }

    public function login($email_id, $password) {
        
       $sql = " SELECT"
                . " email_id,password,reg_as,reg_no"
                . " FROM register WHERE"
                . " email_id = '$email_id' AND password = '$password'";
        $data = $this->dbObj->ExecuteQuery($sql, 1);
        if (mysqli_num_rows($data) > 0) {
            $fetch_data = mysqli_fetch_assoc($data);
            $_SESSION['type'] = $fetch_data['reg_as'];
            $_SESSION['reg_no'] = $fetch_data['reg_no'];
			$_SESSION['email_id'] = $fetch_data['email_id'];
			if($_SESSION['type']=='D')
            header("location:donor_profile.php");
		     if($_SESSION['type']=='V')
            header("location:vendor_profile.php");
		    if($_SESSION['type']=='S')
            header("location:seeker_profile.php");
		
		
			
			 
        }
			   
		
		else {
            echo "<script>window.location='index.php';alert('Invalid User Name or Password !!')</script>";
        }
    }

}

?>
