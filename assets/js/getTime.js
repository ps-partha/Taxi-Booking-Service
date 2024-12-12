const otpFields = document.querySelectorAll('.otp-field');

        otpFields.forEach((field, index) => {
            field.addEventListener('input', (event) => {
                const input = event.target;
                if (input.value.length === 2) {
                    if (index < otpFields.length - 1) {
                        otpFields[index + 1].focus();
                    }
                }
            });

            field.addEventListener('keydown', (event) => {
                const isBackspace = event.key === 'Backspace' || event.keyCode === 8;
                if (isBackspace && !field.value && index > 0) {
                    otpFields[index - 1].focus();
                }
            });
        });


        function BookOption(){

        }
        function RegularBooking(){
            document.getElementById("Airport").style.display = "none";
            document.getElementById("Regular").style.display = "block";

        }

        function AirportBooking(){
            document.getElementById("Regular").style.display = "none";
            document.getElementById("Airport").style.display = "block";
        }