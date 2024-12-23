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
    margin: 40px 8px;
    color: whitesmoke;
    }
    .main-two .date p{
    margin-top:36px;
    }
    .numcourse{
    display: flex;
    align-items: center;
    justify-content: space-between;
    /* background: white; */
    position: absolute;
    bottom: 18%;
    padding-right: 181px;
    }
    .numcourse .course h4{
    position: absolute;
    right: 3%;
    bottom: 0%;
    }


    .last{
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: absolute;
    bottom:3%;
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
    .brgy p{
    font-size: 10px;
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
    /* likod na id */
    .likod {
        width: 260px;
        height: 380px;
        background: #ffffff;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;

    }


    /* table */

       .table-container {
            border: 2px solid black;
            border-collapse: collapse;
            text-align: center;
            position: absolute;
            top: 68%;
            right:21.5%;
            transform: rotate(-90deg);
            transform-origin: left;

        }
        .table-container th, .table-container td {
            border: 1px solid black;
            padding: 1px 4px;

        }
        .table-container th {
            font-weight: bold;
            text-transform: uppercase;
            background-color: black;
            color: white;
            font-size: 10px;
        }
        .table-container tr{
            font-size:10px;
        }
        .semester-title {
            text-align: left;
            font-weight: bold;
        }

        .likod-one{
            display: flex;
            align-items: center;
            justify-content: space-around;

        }
        .one-table{
            background-color: blue;
            margin: 5px;
            width: 40%;
        }
        .one-right{

        margin-right: 10px;
        margin-top: 16px;
        width: 98%;
        height: 318px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        }
        .parag p{
            font-size: 9px;
            text-align: center;
        }
        .parag-name{
            margin-top: 20px;
        }
        .parag-name p{
            font-size: 9px;
            text-align: center;
            font-weight: bold;

        }
        .parag2{
            font-size: 9px;
            text-align: center;
           margin-top: 1px;
        }
        .parag3{
            font-size: 9px;
            text-align: center;
            margin-top: 0px;
        }
        .parag4{
            font-size: 9px;
            text-align: center;
            font-weight: bold;
            margin-top: 0px;
        }
        .parag2 .span{
            font-weight: bold;
        }
        .parag2 .span1{
            font-weight: bold;
        }
        .parag5{
            margin-top: 1px;
            font-size: 9px;
            text-align: center;
            font-weight: bold;
            background: black;
            color: white;
            padding: 8px;

        }
        .parag1span{
            font-weight: bold;
        }
        .likod-two{
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: black;
            color: white;
            padding: 4px;
            font-size: 12px;
            border-bottom-right-radius:10px ;
            border-bottom-left-radius:10px ;
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
                         <img src="" alt="">
                     </div>
                     <div class="signature">
                        <img src="" alt="">
                     </div>
                 </div>
                 <div class="main-image">
                     <div class="image">
                         <img src="" alt="">
                     </div>
                 </div>
            </div>
         <div class="mainconsaubos">
             <div class="main-two">
                     <div class="date">
                         <p>Date of birth:<br>12/08/2003</p>
                     </div>
                     <div class="main-name">
                         <div class="name">
                         <h3 id="first_name"></h3>
                         </div>
                         <div class="brgy">
                             <p>Brgy.Manaul,Hilongos</p>
                         </div>
                     </div>
             </div>
             <div class="numcourse">
                 <div class="number">
                     <h4>22-003356</h4>
                 </div>
                 <div class="course">
                     <h4 id="student_course"></h4>
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


    <script>
        const apiKey = '{{ (config('system.api_key')) }}';
        const url = new URL(window.location.href);
        const pathname = url.pathname;
        const fullname = pathname.split('/').pop(); // Extract last part of the URL
        const decode_fullname = decodeURIComponent(fullname);
        console.log(decode_fullname);

        fetch('https://api-portal.mlgcl.edu.ph/api/external/employee-list', {
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
            console.log(data.data);

            // Find the employee that matches the decoded fullname
            const employee = data.data.find(employee =>
                employee.first_name + " " + employee.last_name === decode_fullname
            );

            if (employee) {
                console.log("Matched Employee:", employee);

                // Update the DOM with employee data
                document.getElementById('first_name').textContent = `${employee.first_name} ${employee.last_name}`;
                document.getElementById('student_course').textContent = employee.course || 'No course data';
                document.querySelector('.qr-code img').src = employee.qr_code || '';
                document.querySelector('.signature img').src = employee.signature || '';
                document.querySelector('.image img').src = employee.image || '';
                // Update other employee fields as needed
            } else {
                console.log("No employee found with the given full name.");
            }
        })
        .catch(error => {
            console.error('Error fetching employee:', error);
        });
    </script>



@endsection
