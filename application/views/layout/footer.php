<footer>
  <div class="pull-right">
    ©2017 All Rights Reserved. HITACHI SERVICE CENTER by HITACHI SALES (THAILAND),LTD.
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

<!-- jQuery -->
<script src="<?=base_url();?>assets/theme/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?=base_url();?>assets/theme/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url();?>assets/theme/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?=base_url();?>assets/theme/vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="<?=base_url();?>assets/theme/vendors/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="<?=base_url();?>assets/theme/vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="<?=base_url();?>assets/theme/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="<?=base_url();?>assets/theme/vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="<?=base_url();?>assets/theme/vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="<?=base_url();?>assets/theme/vendors/Flot/jquery.flot.js"></script>
<script src="<?=base_url();?>assets/theme/vendors/Flot/jquery.flot.pie.js"></script>
<script src="<?=base_url();?>assets/theme/vendors/Flot/jquery.flot.time.js"></script>
<script src="<?=base_url();?>assets/theme/vendors/Flot/jquery.flot.stack.js"></script>
<script src="<?=base_url();?>assets/theme/vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="<?=base_url();?>assets/theme/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="<?=base_url();?>assets/theme/vendors/Flot/date.js"></script>
<script src="<?=base_url();?>assets/theme/vendors/flot-spline/js/jquery.flot.spline.js"></script>
<script src="<?=base_url();?>assets/theme/vendors/flot.curvedlines/curvedLines.js"></script>

<!-- validator -->
    <script src="<?=base_url();?>assets/js/validator.min.js"></script>

<!-- smartWizard plugins -->
<script src="<?=base_url();?>assets/theme/vendors/jQuery-Smart-Wizard/js/jQuery.SmartWizard.js"></script>

<!-- Custom Theme Scripts -->
<script src="<?=base_url();?>assets/theme/build/js/custom.min.js"></script>

<!-- jQuery Smart Wizard -->
    <script>
      $(document).ready(function() {
        $('#wizard').smartWizard();

        $('#wizard_verticle').smartWizard({
          transitionEffect: 'slide'
        });

        $('.buttonNext').addClass('btn btn-success');
        $('.buttonPrevious').addClass('btn btn-primary');
        $('.buttonFinish').addClass('btn btn-default');
      });
    </script>
<!-- /jQuery Smart Wizard -->
<!-- validator -->
    <script>
      // initialize the validator function
      validator.message.date = 'not a real date';

      // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
      $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

      $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;

        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
          submit = false;
        }

        if (submit)
          this.submit();

        return false;
      });
    </script>
<!-- /validator -->
</body>
</html>
