<?php
DEFINE('admin', true);

class Template
{
    public $date = "";
    private $its=array();

    public function __construct()
    {
        require("../../config.php");
        date_default_timezone_set('NZ');
        $this->date = date('d/m/Y');
        $this->time = date("h:i A");
        $this->its=$config->its;
    }

    public function it()
    {     

        $html = <<<EOD
        <div class="row">
            <div class="col-md-6 col-sm-12 px-5"><br>
             <form>
             <label>Schedule</label>
            <select class="form-control" name="sched" >
                <option value="Login" selected>Login</option>
                <option value="First Break">First Break</option>
                <option value="Lunch">Lunch</option>
                <option value="Second Break">Second Break</option>
                <option value="Logout">Logout</option>
                </select>
                <br>
                <label>TASK LIST:</label>
                <textarea class="form-control" name="task_list" cols="60" rows="5"></textarea><br>
                <label>FOR ADMIN CHECKING:</label>
                <textarea class="form-control" name="admin_check" cols="60" rows="5"></textarea><br>
                <label>FOR MANAGEMENT CHECKING:</label>
                <textarea class="form-control" name="management_check" cols="60" rows="5"></textarea><br>
               
                <div class="d-grid gap-2">
                <input id="generateIT" type="submit" value="Submit / Save" class="btn btn-outline-primary btn-lg">
                <button type="button" onclick="copyToClipboard('.previewIT')" class="btn btn-outline-danger btn-lg">Copy</button>
                </div> 
                </form>
                </div>    
              <textarea readonly class="col-md-6 col-sm-12 pr-5 previewIT border border-secondary bg-light"></textarea>     
        </div>
        
        EOD;

        echo json_encode(array('html' => $html,'token'=>$_GET['token']));
    }

    public function generateIT(){
        //IT
       
        $tasklist = isset($_GET['data']['task_list']) ? trim($_GET['data']['task_list']) : ''; 
        $tasklist = explode("\n", $tasklist); 
        $admin_check = isset($_GET['data']['admin_check']) ? trim($_GET['data']['admin_check']) : '';
        $admin_check = explode("\n", $admin_check);
        $management_check = isset($_GET['data']['management_check']) ? trim($_GET['data']['management_check']) : ''; 
        $management_check = explode("\n", $management_check); 
        $sched = $_GET["data"]["sched"];
        $html=<<<EOD
        :$this->date\n$sched: $this->time \n
        TASK LIST:\n
        EOD;
        foreach ($tasklist as $i => $x) {
            $num = $i + 1;
            $html.= "$num. ". htmlentities($x)."\n";
        }
        $html.="\nFOR ADMIN CHECKING:\n";
        foreach ($admin_check as $i => $x) {
            $num = $i + 1;
            $html.= "$num. ". htmlentities($x)."\n";
        }
        $html.="\nFOR MANAGEMENT CHECKING:\n";
        foreach ($management_check as $i => $x) {
            $num = $i + 1;
            $html.= "$num. ". htmlentities($x)."\n";
        }


        echo json_encode(array('html' =>$html));
    }

    public function admin1()
    {
        $html = <<<EOD
             <div class="row">
            <div class="col-md-6 col-sm-12 px-5"><br>
             <form>
             <!--<label>Schedule</label>
             <select class="form-control" name="sched" id="admin1Option">
             <option value="Login" selected>Login</option>
             <option value="First Break">First Break</option>
             <option value="Lunch">Lunch</option>
             <option value="Second Break">Second Break</option>
             <option value="Logout">Logout</option>
             </select>
             -->
             
             <label>Admin Name</label>
             <input name="admin" class="form-control" type="text" value="Wilfred">
             <br>
             <label>IT Name</label>
             <select class="form-control" name="itname">
             <option value="">--Please Select--</option>
            EOD;
            foreach($this->its as $x=>$its){
                $html.="<option value=".$its['id'].">".$its['name']."</option>";
            }
        
            $html.= <<<EOD
            </select><Br>
            <label>Currently Working on:</label>
            <textarea readonly class="form-control" name="currently" cols="60" rows="5"></textarea><br>
            <label>On Queue:</label>
            <textarea readonly class="form-control" name="onQueue" cols="60" rows="5"></textarea><br>
            <label>Other Task:</label>
            <textarea readonly class="form-control" name="otherTask" cols="60" rows="5"></textarea><br>
            <label>Endorsed:</label>
            <textarea readonly class="form-control" name="endorsed" cols="60" rows="5"></textarea><br>
            <label>Currently Checking:</label>
            <textarea readonly class="form-control" name="currChecking" cols="60" rows="5"></textarea><br>
            <label>Check:</label>
            <textarea readonly class="form-control" name="check" cols="60" rows="5"></textarea><br>
            <label>For Management Check:</label>
            <textarea readonly class="form-control" name="managementCheck" cols="60" rows="5"></textarea><br>
            <label>Links:</label>
            <textarea readonly class="form-control" name="links"  cols="60" rows="5"></textarea><br>
            
            <div class="d-grid gap-2">
            <input id="generateAdmin1" type="submit" value="Submit / Save" class="btn btn-outline-primary btn-lg">
            <button type="button" onclick="copyToClipboard('.previewAdmin1')" class="btn btn-outline-danger btn-lg">Copy</button>
            </div> 
            </form>
            </div>    
            <textarea class="col-md-6 col-sm-12 pr-5 previewAdmin1 border border-secondary bg-light" readonly></textarea>     
        </div>
        
        EOD;

        echo json_encode(array('html' => $html,'token'=>$_GET['token']));
    }

    public function generateAdmin1(){
        //IT
       
        //$tasklist = isset($_GET['data']['task_list']) ? trim($_GET['data']['task_list']) : ''; 
        $admin = isset($_GET['data']['admin']) ? trim($_GET['data']['admin']) : ''; 
        $itname = isset($_GET['data']['admin']) ? trim($_GET['data']['itname']) : ''; 
        $currently = isset($_GET['data']['currently']) ? trim($_GET['data']['currently']) : ''; 
        $currently = explode("\n", $currently); 
        $onQueue = isset($_GET['data']['onQueue']) ? trim($_GET['data']['onQueue']) : '';
        $onQueue = explode("\n", $onQueue);
        $otherTask = isset($_GET['data']['otherTask']) ? trim($_GET['data']['otherTask']) : '';
        $otherTask = explode("\n", $otherTask);
        $endorsed = isset($_GET['data']['endorsed']) ? trim($_GET['data']['endorsed']) : '';
        $endorsed = explode("\n", $endorsed);
        $currChecking = isset($_GET['data']['currChecking']) ? trim($_GET['data']['currChecking']) : '';
        $currChecking = explode("\n", $currChecking);
        $check = isset($_GET['data']['check']) ? trim($_GET['data']['check']) : '';
        $check = explode("\n", $check);
        $managementCheck = isset($_GET['data']['managementCheck']) ? trim($_GET['data']['managementCheck']) : '';
        $managementCheck = explode("\n", $managementCheck);
        $links = isset($_GET['data']['links']) ? trim($_GET['data']['links']) : '';
        $links = explode("\n", $links);
       // $sched = $_GET["data"]["sched"];
        $html=<<<EOD
        Admin Name: $admin \n
        :$this->date: $this->time \n
        IT Tasklist Update: $itname
        Currently Working On:\n
        EOD;
        foreach ($currently as $i => $x) {
            $num = $i + 1;
            $html.= "$num. ". htmlentities($x)."\n";
        }
        $html.="\nOn Queue:\n";
        foreach ($onQueue as $i => $x) {
            $num = $i + 1;
            $html.= "$num. ". htmlentities($x)."\n";
        }
        $html.="\nOther Tasks:\n";
        foreach ($otherTask as $i => $x) {
            $num = $i + 1;
            $html.= "$num. ". htmlentities($x)."\n";
        }
        $html.="\nEndorsed:\n";
        foreach ($endorsed as $i => $x) {
            $num = $i + 1;
            $html.= "$num. ". htmlentities($x)."\n";
        }
        $html.="\nCurrently Checking:\n";
        foreach ($currChecking as $i => $x) {
            $num = $i + 1;
            $html.= "$num. ". htmlentities($x)."\n";
        }
        $html.="\nCheck:\n";
        foreach ($check as $i => $x) {
            $num = $i + 1;
            $html.= "$num. ". htmlentities($x)."\n";
        }
        $html.="\nManagement Check:\n";
        foreach ($managementCheck as $i => $x) {
            $num = $i + 1;
            $html.= "$num. ". htmlentities($x)."\n";
        }
        $html.="\nLinks:\n";
        foreach ($links as $i => $x) {
            $num = $i + 1;
            $html.= "$num. ". htmlentities($x)."\n";
        }


        echo json_encode(array('html' =>$html));
    }

    public function admin2()
    {

        echo "admin1";
    }

    public function error404()
    {

        echo "<b>ERROR 404</b>";
    }
}
