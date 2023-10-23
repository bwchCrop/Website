<script>
   function onSubmit(token) {
          disableButton();
          document.getElementById("token").value = token;
          document.getElementById("confirmation").value = "Hadir";
          document.getElementById("patient-form").submit();
   }

   function onSubmitCancel(token) {
          disableButton();
          document.getElementById("token").value = token;
          document.getElementById("confirmation").value = "Cancel";
          document.getElementById("patient-form").submit();
   }

   function disableButton() {
          document.querySelectorAll('button').forEach(elem => {
               elem.disabled = true;
          })
   }
 </script>