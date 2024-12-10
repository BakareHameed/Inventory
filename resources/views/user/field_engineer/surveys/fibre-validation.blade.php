 <!-- Script for form Validation before submission -->
 <script type="text/javascript">
     function validateFormFibre(id) {

         let feasible = document.getElementById(id + "Fibre");
         let Nfeasible = document.getElementById("no_fease" + id + "Fibre");
         console.log(feasible.value, Nfeasible.value);
         if (!feasible.checked && !Nfeasible.checked) {
             alert("Feasibility can't be Null!!");
             return false
         }

         let reason = document.forms["fibreForm" + id]["reason"].value;
         let non_feasibility_proof = document.forms["fibreForm" + id]["non_feasibility_proof"].value;
         if (reason == "") {
             alert("State Reason for non feasibility please.");
             return false;
         }

         if (non_feasibility_proof == "") {
             alert("Provide pictoral evidence for non feasibility.");
             return false;
         }
     }
 </script>
 <!-- End of Script for form Validation before submission  -->
