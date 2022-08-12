<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Health Record</title>
    <!-- bootstrap only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <style>
        * {
            font-family: "Times";
        }
        td{
            padding-left: 6px;
            font-size: 13px;
        }
        .bt {
            border-top: 1px solid;
        }
        .bb {
            border-bottom: 1px solid;
        }
        .bs{
            border-left: 1px solid;
        }
        .be{
            border-right: 1px solid;
        }
        input[type=checkbox] { 
            display: inline; 
        }
        input[type=checkbox]:before { 
            font-family: DejaVu Sans; 
        }
        .page_break { 
            page-break-before: always; 
        }
        pre{
            font-size: 13px;
        }
    </style>
    <table class="bs be bt bb" style="width:  685px;">
        <tr style="border: none;">
            <td style="width: 5%; border: none;"></td><td style="width: 5%; border: none;"></td>
            <td style="width: 5%; border: none;"></td><td style="width: 5%; border: none;"></td>
            <td style="width: 5%; border: none;"></td><td style="width: 5%; border: none;"></td>
            <td style="width: 5%; border: none;"></td><td style="width: 5%; border: none;"></td>
            <td style="width: 5%; border: none;"></td><td style="width: 5%; border: none;"></td>
            <td style="width: 5%; border: none;"></td><td style="width: 5%; border: none;"></td>
            <td style="width: 5%; border: none;"></td><td style="width: 5%; border: none;"></td>
            <td style="width: 5%; border: none;"></td><td style="width: 5%; border: none;"></td>
            <td style="width: 5%; border: none;"></td><td style="width: 5%; border: none;"></td>
            <td style="width: 5%; border: none;"></td><td style="width: 5%; border: none;"></td>
        </tr>
        <tr>
            <td class="be" colspan="3" style="height: 50px;"></td>
            <td class="be" colspan="7"></td>
            <td class="be" colspan="6"></td>
            <td colspan="4"></td>
        </tr>
        <tr class="bt bs be">
            <td colspan="9" style="height: 40px;"> Date of Medical Examination: January 20, 2001</td>
            <td colspan="4" style="border: none;">SR-Code: 19-87604</td>
            <td colspan="7" class="border-start-0 border-end-1">Program: BS Information Technology</td>
        </tr>
        <tr class="bt">
            <td class="be" colspan="14" style="height: 170px;"></td>
            <td colspan="6"></td>
        </tr>
        <tr class="bt" style="border-bottom: none;">
            <td colspan="7" style="height: 20px;">
                <b>LAST NAME:</b> 
                CALMA
            </td>
            <td colspan="7">
                <b>FIRST NAME:</b> 
                JOSEPH
            </td>
            <td colspan="6">
                <b>MDDLE NAME:</b> 
                ERMITA
            </td>
        </tr>
        <tr>
            <td colspan="20" style="height: 20px;">
                <b>HOME ADDRESS:</b> 
                LUMBANGAN, TUY, BATANGAS
            </td>
        </tr>
        <tr>
            <td colspan="20" style="height: 20px;">
                <b>DORMITORY ADDRESS: </b>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="height: 20px;">
                <b>SEX:</b>
                FEMALE
            </td>
            <td colspan="2">
                <b>AGE:</b> 
                20
            </td>
            <td colspan="4">
                <b>STATUS: </b>
                MARRIED
            </td>
            <td colspan="6">
                <b>RELIGION:</b>
                IGLESIA NI CRISTO
            </td>
            <td colspan="5">
                <b>CONTACT #:</b>
                0906716585
            </td>
        </tr>
        <tr>
            <td colspan="10" style="height: 20px;">
                <b>DATE OF BIRTH:</b>
                JANUARY 06, 2001
            </td>
            <td colspan="10">
                <b>PLACE OF BIRTH:</b>
                NASUGBU, BATANGAS
            </td>
        </tr>
        <tr class="bt">
            <td colspan="20" style="height: 20px;">
                <b>INCASE OF EMERGENCY PLEASE CONTACT:</b>
            </td>
        </tr>
        <tr>
            <td colspan="10" style="height: 20px;">
                <b>NAME: </b>
                IRENE E. CALMA
            </td>
            <td colspan="10">
                <b>RELATION: </b>
                MOTHER
            </td>
        </tr>
        <tr>
            <td colspan="20" style="height: 20px;">
                <b>BUSINESS ADDRESS: </b>
                LUMBANGAN, TUY, BATANGAS
            </td>
        </tr>
        <tr>
            <td colspan="10" style="height: 20px;">
                <b>LANDLINE:</b>
            </td>
                <td colspan="10">
                <b>CELLPHONE NO:</b>
                09072803306
            </td>
        </tr>
        <tr class="bt">
            <td colspan="20">
                <b>PAST MEDICAL HISTORY:</b>
            </td>
        </tr>
        <tr>
            <td colspan="2">Past illness:</td> 
            <td colspan="7">
                <input type="checkbox" name="asthma" checked>Asthma; Last Attack: ________________
            </td>
            <td colspan="2">
                <input type="checkbox" name="measles">Measles
            </td>
            <td colspan="9">
                <input type="checkbox">Hospitalization _______________________________
            </td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="7">
                <input type="checkbox" name="heart disease">Heart Disease
            </td>
            <td colspan="2">
                <input type="checkbox" name="mumps">Mumps
            </td>
            <td colspan="9">
                <input type="checkbox" name="operation">Operation ___________________________________
            </td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="7">
                <input type="checkbox" name="hypertension">Hypertension
            </td>
            <td colspan="2">
                <input type="checkbox" name="varicella">Varicella
            </td>
            <td colspan="9">
                <input type="checkbox" name="accident">Accident ____________________________________
            </td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="7">
                <input type="checkbox" name="epilepsy">Epilepsy
            </td>
            <td colspan="2"></td>
            <td colspan="9">
                <input type="checkbox" name="disability">Disability ___________________________________
            </td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="18">
                <input type="checkbox" name="diabetes">Diabetes
            </td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="18">
                <input type="checkbox" name="thyroid problem">Thyroid Problem
            </td>
        </tr>
        <tr>
            <td colspan="2">Allergy:</td>
            <td colspan="2">Food:</td>
            <td colspan="2">
                <input type="checkbox" name="foodallergy">No
            </td>
            <td colspan="2">
                <input type="checkbox" name="foodallergy">Yes;
            </td>
            <td colspan="12">
                Specify: ________________________________________________
            </td>
        </tr> 
        <tr>
            <td colspan="2"></td>
            <td colspan="2">Medicine:</td>
            <td colspan="2">
                <input type="checkbox" name="medicineallergy">No
            </td>
            <td colspan="2">
                <input type="checkbox" name="medicineallergy">Yes;
            </td>
            <td colspan="12">
                Specify: ________________________________________________
            </td>
        </tr>     
        <tr>
            <td colspan="2"></td>
            <td colspan="2">Others:</td>
            <td colspan="2">
                <input type="checkbox" name="othersallergy">No
            </td>
            <td colspan="2">
                <input type="checkbox" name="othersallergy">Yes;
            </td>
            <td colspan="12">
                Specify: ________________________________________________
            </td>
        </tr>   
        <tr>
            <td colspan="2"></td>
            <td colspan="2"></td>
            <td colspan="2">
                <input type="checkbox" name="othersallergy">No
            </td>
            <td colspan="2">
                <input type="checkbox" name="othersallergy">Yes;
            </td>
            <td colspan="12">
                Specify: ________________________________________________
            </td>
        </tr>
        <tr>
            <td colspan="20">Medication Immunization:</td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="2">BCG</td>
            <td colspan="2">
                <input type="checkbox" name="" id="">Yes
            </td>
            <td colspan="2">
                <input type="checkbox" name="" id="">No
            </td>
            <td colspan="2"></td>
            <td colspan="2">Hepa B</td>
            <td colspan="4">
                <input type="checkbox" name="" id="">Yes;
                ______ doses
            </td>
            <td colspan="5">
                <input type="checkbox" name="" id="">No
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="2">MMR</td>
            <td colspan="2">
                <input type="checkbox" name="" id="">Yes
            </td>
            <td colspan="2">
                <input type="checkbox" name="" id="">No
            </td>
            <td colspan="2"></td>
            <td colspan="2">DPT</td>
            <td colspan="4">
                <input type="checkbox" name="" id="">Yes;
                ______ doses
            </td>
            <td colspan="5">
                <input type="checkbox" name="" id="">No
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="2">Hepa A</td>
            <td colspan="2">
                <input type="checkbox" name="" id="">Yes
            </td>
            <td colspan="2">
                <input type="checkbox" name="" id="">No
            </td>
            <td colspan="2"></td>
            <td colspan="2">OPV</td>
            <td colspan="4">
                <input type="checkbox" name="" id="">Yes;
                ______ doses
            </td>
            <td colspan="5">
                <input type="checkbox" name="" id="">No
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="2">Typhoid</td>
            <td colspan="2">
                <input type="checkbox" name="" id="">Yes
            </td>
            <td colspan="2">
                <input type="checkbox" name="" id="">No
            </td>
            <td colspan="2"></td>
            <td colspan="2">HIB</td>
            <td colspan="4">
                <input type="checkbox" name="" id="">Yes;
                ______ doses
            </td>
            <td colspan="5">
                <input type="checkbox" name="" id="">No
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="2">Varicella</td>
            <td colspan="2">
                <input type="checkbox" name="" id="">Yes
            </td>
            <td colspan="15">
                <input type="checkbox" name="" id="">No
            </td>
        </tr>
        <tr class="bt">
            <td colspan="20">
                <b>PUBERTAL HISTORY</b>
            </td>
        </tr>
        <tr>
            <td colspan="7">Male</td>
            <td colspan="13">Female</td>
        </tr>
        <tr>
            <td colspan="7">Age of onset: _________</td>
            <td colspan="5">Menarche: _____________</td>
            <td colspan="8">LMP: _____________</td>
        </tr>
        <tr>
            <td colspan="7"></td>
            <td colspan="3">Dsymenorhea</td>
            <td colspan="10">
                <input type="checkbox" name="" id="">No 
                <input type="checkbox" name="" id="">Yes; Medicine;_______________
            </td>
        </tr>
        <tr class="bt">
            <td colspan="20">
                <b>FAMILY HISTORY:</b>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <input type="checkbox" name="" id="">Diabetes
            </td>
            <td colspan="4">
                <input type="checkbox" name="" id="">Heart Disease
            </td>
            <td colspan="4">
                <input type="checkbox" name="" id="">Mental Illness
            </td>
            <td colspan="4">
                <input type="checkbox" name="" id="">Cancer
            </td>
            <td colspan="4"></td>
        </tr>
        <tr>
            <td colspan="4">
                <input type="checkbox" name="" id="">Hypertension
            </td>
            <td colspan="4">
                <input type="checkbox" name="" id="">Kidnet Disease
            </td>
            <td colspan="4">
                <input type="checkbox" name="" id="">Epilepsy
            </td>
            <td colspan="8">
                <input type="checkbox" name="" id="">Others: ______________________
            </td>
        </tr>
        <tr>
            <td colspan="3">Father:</td><td colspan="7">Occupation: ______________________</td>
            <td colspan="3">Mother:</td><td colspan="7">Occupation: ______________________</td>
        </tr>
        <tr>
            <td colspan="5">Present Marital Status: </td>
            <td colspan="3">
                <input type="checkbox" name="" id="">Married
            </td>
            <td colspan="3">
                <input type="checkbox" name="" id="">Unmarried
            </td>
            <td colspan="9">
                <input type="checkbox" name="" id="">Separated
            </td>
        </tr>
    </table>

    <div class="page_break"></div>

    <table class="bs be bt bb" style="width:  685px;">
        <tr style="border: none;">
            <td style="width: 5%; border: none;"></td><td style="width: 5%; border: none;"></td>
            <td style="width: 5%; border: none;"></td><td style="width: 5%; border: none;"></td>
            <td style="width: 5%; border: none;"></td><td style="width: 5%; border: none;"></td>
            <td style="width: 5%; border: none;"></td><td style="width: 5%; border: none;"></td>
            <td style="width: 5%; border: none;"></td><td style="width: 5%; border: none;"></td>
            <td style="width: 5%; border: none;"></td><td style="width: 5%; border: none;"></td>
            <td style="width: 5%; border: none;"></td><td style="width: 5%; border: none;"></td>
            <td style="width: 5%; border: none;"></td><td style="width: 5%; border: none;"></td>
            <td style="width: 5%; border: none;"></td><td style="width: 5%; border: none;"></td>
            <td style="width: 5%; border: none;"></td><td style="width: 5%; border: none;"></td>
        </tr>

        <tr>
            <td colspan="20">
                <b>PHYSICAL EXAMINATION</b>
            </td>
        </tr>

        <tr>
            <td colspan="20" style="height: 30px;">
                Weight: _________ Height: _________ Body Mass Index (BMI) (Weight in kg/height in meter sq.) ___________
            </td>
        </tr>

        <tr>
            <td colspan="20" style="height: 30px;">
                Temparature: ______________ HR: ______________ BP: __________ Vision: ____________ Hearing: ____________
            </td>
        </tr>

        <tr>
            <td colspan="20" style="height: 30px;">
                Chest X-ray Result: ______________________ Date: ___________________
            </td>
        </tr>

        <tr>
            <td colspan="20" style="height: 30px;">
                Blood Type: ______________________
            </td>
        </tr>

        <tr>
            <td colspan="20" style="height: 30px;">
                Please check if normal. Describe only the abnormal findings in the space below
            </td>
        </tr>
        <tr>
            <td colspan="20" style="height: 30px;">
                <pre>(      )  General Survey</pre>
            </td>
        </tr>
        <tr>
            <td colspan="20" style="height: 30px;">
                <pre>(      )  Skin</pre>
            </td>
        </tr>
        <tr>
            <td colspan="20" style="height: 30px;">
                <pre>(      )  Eyes</pre>
            </td>
        </tr>
        <tr>
            <td colspan="20" style="height: 30px;">
                <pre>(      )  Ears</pre>
            </td>
        </tr>
        <tr>
            <td colspan="20" style="height: 30px;">
                <pre>(      )  Nose</pre>
            </td>
        </tr>
        <tr>
            <td colspan="20" style="height: 30px;">
                <pre>(      )  Teeth</pre>
            </td>
        </tr>
        <tr>
            <td colspan="20" style="height: 30px;">
                <pre>(      )  Gums</pre>
            </td>
        </tr>
        <tr>
            <td colspan="20" style="height: 30px;">
                <pre>(      )  Neck</pre>
            </td>
        </tr>
        <tr>
            <td colspan="20" style="height: 30px;">
                <pre>(      )  Heart</pre>
            </td>
        </tr>
        <tr>
            <td colspan="20" style="height: 30px;">
                <pre>(      )  Chest</pre>
            </td>
        </tr>
        <tr>
            <td colspan="20" style="height: 30px;">
                <pre>(      )  Lungs</pre>
            </td>
        </tr>
        <tr>
            <td colspan="20" style="height: 30px;">
                <pre>(      )  Abdomen</pre>
            </td>
        </tr>
        <tr>
            <td colspan="20" style="height: 30px;">
                <pre>(      )  Musculoskeletal</pre>
            </td>
        </tr>
        <tr>
            <td colspan="20">
                <b>ASSESSMENT DIAGNOSIS</b>
            </td>
        </tr>
        <tr>
            <td colspan="6" style="height: 30px;"></td>
            <td colspan="1">NO</td>
            <td colspan="1">YES</td>
            <td colspan="12">IF YES;</td>
        </tr>
        <tr>
            <td colspan="6">1. Drinking</td>
            <td colspan="1"><input type="checkbox" name="" id=""></td>
            <td colspan="1"><input type="checkbox" name="" id=""></td>
            <td colspan="12">How much? ______________ How often? ___________________</td>
        </tr>
        <tr>
            <td colspan="6">2. Smoking</td>
            <td colspan="1"><input type="checkbox" name="" id=""></td>
            <td colspan="1"><input type="checkbox" name="" id=""></td>
            <td colspan="12">Number of Sticks/day: __________ Since when? ________________</td>
        </tr>
        <tr>
            <td colspan="6">3. Drug Use</td>
            <td colspan="1"><input type="checkbox" name="" id=""></td>
            <td colspan="1"><input type="checkbox" name="" id=""></td>
            <td colspan="12">Number of Sticks/day: ______________ Regular use: YES NO</td>
        </tr>
        <tr>
            <td colspan="6">4. Driving</td>
            <td colspan="1"><input type="checkbox" name="" id=""></td>
            <td colspan="1"><input type="checkbox" name="" id=""></td>
            <td colspan="12">Specify vehicle: ______________ With license: YES NO</td>
        </tr>
        <tr>
            <td colspan="6">5. Abuse(Physical, Sexual, Verbal)</td>
            <td colspan="1"><input type="checkbox" name="" id=""></td>
            <td colspan="1"><input type="checkbox" name="" id=""></td>
            <td colspan="12">Specify what kind of abuse: ______________</td>
        </tr>
    </table>
</body>
</html>