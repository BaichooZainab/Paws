function fetchLS(){
    document.querySelector("#txtemail").value = localStorage.getItem("pawem");
    document.querySelector("#txtpass").value = localStorage.getItem("pawpwd");

    }
    window.addEventListener("load", fetchLS);
    function remem(){
    
     var chk = document.querySelector("#chkrem");
    
     if (chk.checked){
     var em = document.querySelector("#txtemail").value;
    var pwd = document.querySelector("#txtpass").value;
   
    localStorage.setItem("pawem", em);
     localStorage.setItem("pawpwd", pwd);

     }
     else{
     localStorage.removeItem("pawem");
     localStorage.removeItem("pawpwd");

     }
    }


    function fetchLSs(){
        document.querySelector("#txtdemail").value = localStorage.getItem("pawdem");
        document.querySelector("#txtdpass").value = localStorage.getItem("pawdpwd");
        }
        window.addEventListener("load", fetchLS);
        function remem(){
        var chk = document.querySelector("#chkrem");
        if (chk.checked){
            var em = document.querySelector("#txtdemail").value;
            var pwd = document.querySelector("#txtdpass").value;

        localStorage.setItem("pawdem", em);
        localStorage.setItem("pawdpwd", pwd);
        }
        else{
            localStorage.removeItem("pawdem");
            localStorage.removeItem("pawdpwd");
        }
        }

        function fetchLSs(){
            document.querySelector("#txtoemail").value = localStorage.getItem("pawoem");
            document.querySelector("#txtopass").value = localStorage.getItem("pawopwd");
            }
            window.addEventListener("load", fetchLS);
            function remem(){
            var chk = document.querySelector("#chkrem");

            if (chk.checked){
                var em = document.querySelector("#txtoemail").value;
                var pwd = document.querySelector("#txtopass").value;
    
                localStorage.setItem("pawoem", em);
                localStorage.setItem("pawopwd", pwd);
            }
            else{
                localStorage.removeItem("pawoem");
                localStorage.removeItem("pawopwd");
            }
            }