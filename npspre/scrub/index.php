<!doctype html>
<html lang="en" dir="ltr">
  <head>


    <title>NPS SCRUB system</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=1000, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="layout.css">
    
    <link rel='stylesheet' href='nprogress.css'/>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
 
    <script charset="utf-8" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script charset="utf-8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script charset="utf-8" src="//cdn.jsdelivr.net/jquery.validation/1.13.1/jquery.validate.min.js"></script>
    <script src='nprogress.js'></script>
    <script charset="utf-8" src="shorten.min.js"></script>
    <script charset="utf-8" src="req1.js"></script>
    <script charset="utf-8" src="webapp.js"></script>

  </head>
  <body>
    <header><span id="logo"> <a href=""><img src="../img/aabaco1.png" alt="Aabaco Small Business"></a> </span></header>
    <div id="page_container">
      
      <h1>Scrub System</h1>
      
      <a id ="back" href="http://spyingsighing.corp.gq1.yahoo.com/nps/#ajax/dashboard.php">Back to Dashboard</a>
      <br>
      <div id="n1">
        <div id="dd">
          <label id="dd1"for="dropdown1">
          Site: <select id="dropdown1">
              <option value="" selected>ALL</option>
              <option value="Bangalore">Bangalore</option>
              <option value="Hillsboro">Hillsboro</option>
              <option value="Teleperformance">Teleperformance</option>
              <option value="smbi">SMBI</option>
            </select></label>
        </div>
        <!--
          <div id="ddd">
          <label id="dd2" for="dropdown2">
            Condition: <select id="dropdown2">
              <option value="" selected>ALL</option>
              <option value="pos">Positive</option>
              <option value="neg">Negative</option>
            </select>
          </label>
      </div>
        -->
      </div>

    <br>
      
      <table class="datatable" id="table_lines">
        <thead>
          <tr>
            <th>Edit</th>
           <!-- <th>ID</th> -->
            <!--<th>Scrub Loc</th> -->
          <!--  <th>Week End'n</th> -->
            <th>Date</th>
            <th>Case ID</th>
            <th>Queue</th>
            <th>Channel</th>
          <!--  <th>Manager</th> -->
            <th>Agent</th>
            <th>CSAT</th>
            <th>Res Rate</th>
            <th>Verbatim</th>
            <th>NPS</th>
            <th>Site</th>
            
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>

    <div class="lightbox_bg"></div>

    <div class="lightbox_container">
      <div class="lightbox_close"></div>
      <div class="lightbox_content">
        
       <h2 id="sc"></h2>
        <form class="form add" id="form_company" data-id="" novalidate>
          <div class="input_container" hidden="hidden">
            <label for="id">ID: </label>
            <div class="field_container">
              <input type="number" min="0" class="text" name="id" id="id" value="" disabled>
            </div>
          </div>
          <!--
          <div class="input_container">
            <label for="scrub_Location">Scrub Location :</label>
            <div class="field_container">
              <input type="text" class="text" name="scrub_Location" id="scrub_Location" value="" disabled>
            </div>
          </div>
          -->
          
          <!--
          <div class="input_container">
            <label for="week_ending">Week Ending: </label>
            <div class="field_container">
              <input type="text" class="text" name="week_ending" id="week_ending" value="" disabled>
            </div>
          </div>
          
          
          <div class="input_container">
            <label for="date">Date: </label>
            <div class="field_container">
              <input type="date" class="text" name="date" id="date" value="" disabled>
            </div>
          </div>
          <div class="input_container">
            <label for="case_id">Case ID: </label>
            <div class="field_container">
              <input type="text" min="0" class="text" name="case_id" id="case_id" value="" disabled>
            </div>
          </div>
          -->
          
          <div class="input_container">
            <label for="queue">Queue: </label>
            <div class="field_container">
              <input type="text" class="text" name="queue" id="queue" value="" disabled>
            </div>
          </div>
          <!--
          <div class="input_container">
            <label for="channel">Channel: </label>
            <div class="field_container">
              <input type="text" class="text" name="channel" id="channel" value="" disabled>
            </div>
          </div>
          -->
          <!--
          <div class="input_container">
            <label for="manager">Manager: </label>
            <div class="field_container">
              <input type="text" class="text" name="manager" id="manager" value="" disabled>
            </div>
          </div>
          -->
          
          <div class="input_container">
            <label for="agent_name">Agent Name: </label>
            <div class="field_container">
              <input type="text" class="text" name="agent_name" id="agent_name" value="" disabled>
            </div>
          </div>
          <div class="input_container">
            <label for="csat_score">CSAT Score: </label>
            <div class="field_container">
              <input type="number" class="text" min="1" max="10" step="1" name="csat_score" id="csat_score" value="" disabled>
            </div>
          </div>          
          <div class="input_container">
            <label for="resolution_rate">Res Rate: </label>
            <div class="field_container">
              <input type="integer" class="text" name="resolution_rate" id="resolution_rate" value="" disabled>
            </div>
          </div>
          <div class="input_container form-group">
            <label for="verbatim">Verbatim: </label>
            <div class="field_container">
              <textarea class="form-control" id="verbatim" name="verbatim" value="" rows="2" disabled></textarea>
            </div>
          </div>
          <div class="input_container">
            <label for="NPS">NPS: </label>
            <div class="field_container">
              <input type="integer" min="1" max="10" class="text" name="NPS" id="NPS" value="" disabled>
            </div>
          </div>
          <!--
          <div class="input_container">
            <label for="site">Site: </label>
            <div class="field_container">
              <input type="text" class="text" name="site" id="site" value="" disabled>
            </div>
          </div>
          -->
          <div class="input_container">
            <label for="level_1">Level 1: </label>
            <div class="field_container">
              <select class="text" name="level_1" id="level_1" required>
                <option value="people">People</option>
                <option value="process">Process Policy</option>
                <option value="product">Product</option>
              </select>
            </div>
          </div>
          
          <div class="input_container" id="level2">
            <label for="level_1">Level 2: </label>
            <div class="field_container">
              <select class="text" name="level_2" id="level_2" required>
                <option class="people">Agent Behaviour</option>
                <option class="people">Communication Skills</option>
                <option class="people">Issue Resolved - No Comments (Promoters)</option>
                <option class="people">WOW Experience</option>
                <option class="people">Positive Experience</option>
                <option class="people">Product knowledge</option>
                <option class="people">CX wants US Support</option>
                <option class="people">Customer Education</option>
                <option class="people">Follow-up Missing</option>
                <option class="people">Hold Procedure</option>
                <option class="people">Incomplete Resolution</option>
                <option class="people">Incorrect Expectation Set</option>
                <option class="people">Incorrect Resolution</option>
                  
                <option class="process">Account Renewal Related</option>
                <option class="process">Cancellation Policy</option>
                <option class="process">Delay in Resolution/ Ease of Reach</option>
                <option class="process">Escalated Case</option>
                <option class="process">Halt-Treatments</option>
                <option class="process">Issues with Phone</option>
                <option class="process">Issues with YID</option>
                <option class="process">Language Barrier (Spanish customer)</option>
                <option class="process">Ownership Disputes</option>
                <option class="process">Password Reset & Issues</option>
                <option class="process">Promotional Offers</option>
                <option class="process">Reactivation Process</option>
                <option class="process">Refund Policy</option>
                <option class="process">Seeking Self Help</option>
                <option class="process">Support for Non-SMB Customer</option>
                <option class="process">Unhappy with redirect</option>
                <option class="process">Verification Policy</option>
                <option class="process">Resolution Speed/ Ease of Reach</option>
               
                <option class="product">Feature Missing</option>
                <option class="product">Aabaco Spin Related</option>
                <option class="product">Account Access Issues</option>
                <option class="product">Business Email Related</option>
                <option class="product">Change Plan/ Upgrade-Downgrade</option>
                <option class="product">Commerce Central Related</option>
                <option class="product">Domain Related</option>
                <option class="product">Duda Mobile</option>
                <option class="product">Ease Of Product Use</option>
                <option class="product">Feature Request</option>
                <option class="product">Listing Related</option>
                <option class="product">Login Issues</option>
                <option class="product">MS or Store Related</option>
                <option class="product">Pricing</option>
                <option class="product">Product Issue</option>
                <option class="product">Site Builder/ Site Solutions</option>
                <option class="product">SWE/KI</option>
                <option class="product">Third Party Issues</option>
                <option class="product">Wallet Related</option>
                <option class="product">Webhosting Related</option>
                
                <option class="other">Other</option>
                
              </select>
            </div>
          </div>
          <!-- Drop down option for other
          <div class="input_container" id="level21">
            <label for="level_2">Comment for Other: <span class="required">*</span></label>
            <div class="field_container">
              <input type="text" class="text" name="level_2" id="level_2" value="">
            </div>
          </div>
          -->
          <div class="input_container" id="level22">
            <label for="relevant_comment">Relevant Comment?</label>
            <div class="field_container">
            <input type="checkbox" name="relevant_comment" id="relevant_comment" value="1">
            </div>
          </div>
          
          <div class="input_container" id="level3">
            <label for="level_3">Level 3: </label>
            <div class="field_container">
              <textarea class="text" name="level_3" id="level_3" required></textarea>
            </div>
          </div>
          
          <input type="hidden" name="flag" id="flag" value="1">
          <input type="hidden" name="yid" id="yid" value="">
          
          
          <div class="button_container">
            <button type="submit">Submit</button>
            <button type="reset" id="cancel">Cancel</button>
          </div>
          
        </form>
      </div>
    </div>

    <noscript id="noscript_container">
      <div id="noscript" class="error">
        <p>JavaScript support is needed to use this page.</p>
      </div>
    </noscript>

    <div id="message_container">
      <div id="message" class="success">
        <p>This is a success message.</p>
      </div>
    </div>

    <div id="loading_container">
      <div id="loading_container2">
        <div id="loading_container3">
          <div id="loading_container4">
            Loading, please wait...
          </div>
        </div>
      </div>
    </div>

  </body>
</html>