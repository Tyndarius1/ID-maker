
@extends('layouts.app')

@section('content')


<style>


    .pinakamain{
    display: flex;
    align-items: center;
    justify-content: space-around;
    gap: 60px;
    }
    .main-container{
    display: flex;
    flex-direction: column;
    width: 260px;
    height: 380px;
    background: #ffffff;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    position: relative;
    }
    .main-one{
    display: flex;
    align-items: center;
    justify-content: space-between;
    }
    .main-two{
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-right: 10px;
    margin: 20px 10px;
    color: whitesmoke;
    }
    .main-two .date p{
    margin-top:36px;
    }
    .numcourse{
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: white;
    position: absolute;
    bottom: 15%;
    padding-right: 221px;
    }

    .numcourse .course h5{
    position: absolute;
    right: 3%;
    bottom: 0%;

    }


    .last{
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: absolute;
    bottom:-10%;
    gap: 80%;
    margin: 6px;
    }
    .logo{
    text-align: center;
    margin: 10px 5px;
    }
    .logo img{
    width: 48px;
    height: 48px;
    }
    .logo p{
    font-size: 8px;
    }
    .qr-code img{
    width: 94px;
    height: 94px;
    position: absolute;
    top: 25%;
    left: 2%;
    }
    .signature img{
    width: 140px;
    height: 140px;
    position: absolute;
    top: 35%;
    left: 2%;
    }
    .image img{
    width: 250px;
    height: 250px;
    position: absolute;
    left: 20%;
    top: 2%;
    }
    .date p{
    font-size: 8px;
    }

    .last p{
    font-size: 8px;
    }
    .mainconsaubos{
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 150px;
    background: #ff6f00;
    clip-path: polygon(0% 30%, 100% 0%, 100% 100%, 0% 100%);
    }


   #student_address{
    font-size:10px;

   }
 #first_name{
    font-weight:bold;
 }

</style>

    <div class="pinakamain">
        <div class="main-container">
            <div class="main-one">
                 <div class="one">
                     <div class="logo">

                         <img src="{{asset('/images/MLG_Logo.19b958c1.png')}}" alt="">
                         <p>MLG COLLEGE <br> OF LEARNING,INC<br> Brgy.Atabay,Hilongos,Leyte</p>
                     </div>
                     <div class="qr-code">
                        <img id="qr_code_img" src="" alt="QR Code">
                    </div>

                     <div class="signature">
                        <img src="" alt="">
                     </div>
                 </div>
                 <div class="main-image">
                     <div class="image">
                         <img src="{{asset('/images/Untitled_design__3___3_-removebg-preview.png')}}" alt="">
                     </div>
                 </div>
            </div>
         <div class="mainconsaubos">
             <div class="main-two">
                     <div class="date">
                         <p>Date of birth: <br><span id="birth_date"></span></p>
                     </div>
                     <div class="main-name">
                         <div class="name" id="first_name">
                         </div>
                         <div class="brgy" id="student_address">

                         </div>
                     </div>
             </div>
             <div class="numcourse">
                 <div class="number">
                     <h5 id="student_id"></h5>
                 </div>
                 <div class="course">
                     <h5 id="student_course"></h5>
                 </div>
             </div>
             <div class="last">
                 <div class="num1">
                     <P>https://mlgcl.edu.ph</P>
                 </div>
                 <div class="num2">
                     <p>mlg@mlgcl.edu.ph</p>
                 </div>
            </div>
         </div>
        </div>
    </div>
    <div>
        <label for="fontSizeControl">Adjust Name Size:</label>
        <input type="range" id="fontSizeControl" min="10" max="50" value="16">
    </div>

    <script>
        const apiKey = '{{ (config('system.api_key')) }}';
        const url = new URL(window.location.href);
        const pathname = url.pathname;
        const fullname = pathname.split('/').pop();
        const decode_fullname = decodeURIComponent(fullname);
   console.log(decode_fullname);

   fetch('https://api-portal.mlgcl.edu.ph/api/external/student-list', {
    method: 'GET',
    headers: {
        'Origin': 'http://idmaker.test',
        'x-api-key': apiKey,
        'Content-Type': 'application/json'
    },
})
.then(response => {
    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
    }
    return response.json();
})
.then(data => {
    console.log('Fetched Student Data:', data);  // Log the entire data to inspect its structure
    const student = data.data.find(student => {
        // Attempting to match both first and last name
        const fullName = `${student.first_name} ${student.last_name}`.toLowerCase();
        return fullName === decode_fullname.toLowerCase();  // Matching full name
    });

    if (student) {
        console.log("Matched Student:", student);
        const firstNameElement = document.getElementById('first_name');
        const middleInitial = student.middle_name ? `${student.middle_name.charAt(0).toUpperCase()}.` : "";

        firstNameElement.innerHTML = `
            ${student.last_name.toUpperCase()}<br>
            ${student.first_name.toUpperCase()} ${middleInitial}`;

        const fontSizeControl = document.getElementById('fontSizeControl');
        fontSizeControl.addEventListener('input', function () {
            firstNameElement.style.fontSize = `${this.value}px`;
        });

        document.getElementById('student_address').textContent = `Brgy. ${student.address.barangay}, ${student.address.municipality}`;
        document.getElementById('birth_date').textContent = student.birthdate ? new Date(student.birthdate).toLocaleDateString() : "N/A";
        document.getElementById('student_course').textContent = student.course?.[0]?.code || "N/A";
        document.getElementById('student_id').textContent = student.student_identification_number?.[0] || "N/A";

        const qrCodeImg = document.getElementById('qr_code_img');
        qrCodeImg.src = student?.qr_code || "";
        qrCodeImg.alt = student?.qr_code ? "Student QR Code" : "No QR Code Available";

    } else {
        console.log("No student found with the given full name.");
    }
})
.catch(error => {
    console.error('Error fetching students:', error);
});


    </script>
@endsection
