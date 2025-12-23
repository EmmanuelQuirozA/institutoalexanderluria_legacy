
  <script>
    let arrow = document.querySelectorAll(".arrow");
    for (var i = 0; i < arrow.length; i++) {
      arrow[i].addEventListener("click", (e)=>{
    let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
    arrowParent.classList.toggle("showMenu");
      });
    }
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".bx-menu");
    console.log(sidebarBtn);
    sidebarBtn.addEventListener("click", ()=>{
      sidebar.classList.toggle("close");
    });
  </script>

  <footer class="bg-primary text-center fixed-bottom custom-footer">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0 text-center p-3" >
      © 2023 Copyright:
      <a class="text-white" href="http://monarchdeveloping.com/">Monarch Developing</a>
    </div>
    <!-- Copyright -->
  </footer>


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.1/dist/sweetalert2.all.min.js" integrity="sha256-RMMHCecth8nmPpX+LRNKqUJJROnKG7MCqpIOALSGJF8=" crossorigin="anonymous"></script>
  
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- datatables JS -->
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>    
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>   
  <script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.3/js/dataTables.fixedColumns.min.js"></script>  
  <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.2.1/js/dataTables.fixedHeader.min.js"></script>  

  
  <!-- Export libraries datatables JS -->
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script> 
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

  <!-- Parsley -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- Switchery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js" integrity="sha512-lC8vSUSlXWqh7A/F+EUS3l77bdlj+rGMN4NB5XFAHnTR3jQtg4ibZccWpuSSIdPoPUlUxtnGktLyrWcDhG8RvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- jQuery Smart Wizard -->
  <!-- <script src="../build/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script> -->

  <!-- PNotify -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/attempt-to-update-packagist/pnotify.js" integrity="sha512-vVCwjYtarAac2AMUNPP0cqRITQ00L8kXCRzUfLInqdz3iPUa/3kuBiXjhcEG4VaBLsBzgcChpq68qzUl1LAZ4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/attempt-to-update-packagist/pnotify.buttons.min.js" integrity="sha512-co9eQf9iBrZ/C9x6P5eMTN2J+U/RHzcY9AymqhM8AgNp7s83z9RndzfsUKSP7O+6CJb1JUf1fOkmjBb4+YT9qQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/attempt-to-update-packagist/pnotify.nonblock.min.js" integrity="sha512-mJQOr6t3UOjsebS+HLKP6ud0JgVLe0SrrGOCixoipDxsmgQfVhRMqfEUajjBjvSDEhQOCl/a3n2LKCuL9p7XXw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  