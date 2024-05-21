
        var accountCreatedMsg = document.getElementById("account-created-msg");
        if (accountCreatedMsg) {
            setTimeout(function() {
                var img = document.createElement("img");
                img.src = "./graphic/icons/tick.png";
                accountCreatedMsg.appendChild(img);
            }, 500);
        }


        
    