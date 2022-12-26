<?php
$title = "Income";
include('layout_header.php');
?>
<section class="section">
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Edit Income</h4>
              </div>
              <div class="card-body">
                <form method="POST" id="editincome" class="needs-validation" novalidate="">
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="DateStart">Start Date</label>
                      <input id="DateStart" type="date" class="form-control needs-validation" required name="DateStart" autofocus>
                    </div>
                    <div class="form-group col-6">
                      <label for="DateEnd">Start Date</label>
                      <input id="DateEnd" type="date" class="form-control needs-validation" required name="DateEnd" autofocus>
                    </div>
                    
                  </div>  
                  
                  <div class="row">
                    <div class="form-group col-6">
                        <label for="IncomeInfo">Income Info</label>
                        <input id="IncomeInfo" type="tel" class="form-control" name="IncomeInfo" required>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label for="Amount">Ammount</label>
                        <input id="Amount" type="tel" class="form-control" name="Amount" required>
                        <div class="invalid-feedback">
                        </div>
                    </div>
                  </div>  
 

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Update
                    </button>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>

<!-- JS Libraies -->

  <script src="../assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="../assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="../assets/js/page/auth-register.js"></script>


  <!-- on form submit js code here -->
    <!-- hidden input will be RoleId,TinNumber,CreatedAt,UpdatedAt -->
<script>
    var retrive_user='';
    $( document ).ready(function() {
        $.ajax({
            url: api_root+"/api/income/<?php echo $_GET['id']; ?>",
            type: 'GET',
            dataType: 'json', // added data type
            success: function(res) {
                //console.log(res);
                if(res==null){
                    window.location.href="user.php";
                }else{
                    set_input_data(res);
                } 
            }
        });

    });

    function set_input_data(item){
      retrive_income=item;
      $('#DateStart').val(moment(item.DateStart).format('YYYY-MM-YY'));
      $('#DateEnd').val(moment(item.DateEnd).format('YYYY-MM-YY'));
      $('#IncomeInfo').val(item.IncomeInfo);
      $('#Amount').val(item.Amount);      
    }

    
    // this is the id of the form
    $("#editincome").submit(function(e) {
      e.preventDefault(); // avoid to execute the actual submit of the form.
      var form_data = retrive_income;
      
      form_data.DateStart=$('#DateStart').val();
      form_data.DateEnd=$('#DateEnd').val();
      form_data.IncomeInfo=$('#IncomeInfo').val();
      form_data.Amount=$('#Amount').val();
      form_data.UpdatedAt=new Date().toJSON();

      var actionUrl = api_root+"/api/income/update";
        //console.log(form_data);
        $.ajax({
            type: "POST",
            url: actionUrl,
            data: form_data, // serializes the form's elements.
            success: function(data)
            {
              //console.log(data); // show response from the php script.
              window.location.href = 'income.php?from=edit';
            }
        });
    });
</script>

<?php
include('layout_footer.php');
?>