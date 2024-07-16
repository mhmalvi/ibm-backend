<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education Agent</title>
    <style>
        section {
            margin: 25px;
            padding: 25px;
        }

        #header {
            display: flex;
            justify-content: space-between;
        }

        /* #header div {
          width: 70px;
          height: 70px;
        } */
        #form_background {
            background-color: #D9D9D9;
            padding: 3px;
            border: 1px solid black;
        }

        #form_background2 {
            padding: 3px;
            border: 1px solid black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .textarea {
            padding: 30px;
            margin: 30px;
        }
    </style>
</head>

<body>
    <!--header-->
    <section>
        <div id="header">
            <div>
                <img src="Screenshot 2024-07-16 121452.png" alt="">
            </div>
            <div>
                <p>
                    Phone: +61 3 94783163 <br>
                    Email: info@ibm.vic.edu.au <br>
                    Website: www.ibm.vic.edu.au <br>
                </p>
            </div>
        </div>
    </section>

    <!--Agent Details-->
    <section>
        <h3 style="text-align: center;">Expression of interest – Education Agent</h3>
        <p>
            Application must be accompanied by
            @if ($copy_of_business_registration != '')
                <input type="checkbox" checked />
            @else
                <input type="checkbox" />
            @endif

            <label for=""> Copy of business registration</label>
            @if ($evidence_of_EATC != '')
                <input type="checkbox" checked />
            @else
                <input type="checkbox" />
            @endif

            <label for=""> Evidence of EATC</label><br>
        </p>
        <h3 style="background-color: orange; padding: 3px; border: 1px solid black;">Agent Details:</h3>
        <table>
            <tbody>
                <tr>
                    <td id="form_background">Company Legal Name:</td>
                    <td>{{ $company_legal_name }}</td>

                    <td id="form_background">Date Of Registration:</td>
                    <td>{{ $date_of_company_registration }}</td>

                </tr>
                <tr>
                    <td id="form_background">Trading as:</td>
                    <td>{{ $trading_as }}</td>

                    <td id="form_background">Business Address:</td>
                    <td>{{ $business_address }}</td>

                </tr>
                <tr>
                    <td id="form_background">ABN:</td>
                    <td>{{ $abn }}</td>

                    <td id="form_background">Year Of Registration:</td>
                    <td>{{ $year_of_registration }}</td>

                </tr>
                <tr>
                    <td id="form_background">Owner's Name:</td>
                    <td>{{ $owners_name }}</td>

                    <td id="form_background">Contact Details:</td>
                    <td>{{ $owners_contact_details }}</td>

                </tr>
                <tr>
                    <td id="form_background">Manager's Name:</td>
                    <td>{{ $manager_name }}</td>

                    <td id="form_background">Contact Details:</td>
                    <td>{{ $manager_contact_details }}</td>

                </tr>
                <tr>
                    <td id="form_background">Phone:</td>
                    <td>{{ $agent_phone }}</td>

                    <td id="form_background">Mobile No.</td>
                    <td>{{ $agent_mobile_no }}</td>

                </tr>
                <tr>
                    <td id="form_background">Website</td>
                    <td>{{ $agent_website }}</td>

                    <td id="form_background">Number of staff:</td>
                    <td>{{ $number_of_staffs }}</td>

                </tr>
            </tbody>
        </table>
        <h3 id="form_background">Number of students referred to Australian education institutions over the past year:
        </h3>
        <table>
            <tbody>
                <tr>
                    <td>High School: {{ $num_students_australian_institutions }}</td>

                    <td>ELICOS: {{ $elicos_st }}</td>

                    <td>TAFE: {{ $tafe_st }}</td>

                    <td>Undergraduate: {{ $undergraduate_st }}</td>

                    <td>Post Graduate: {{ $postgraduate_st }}</td>

                </tr>
            </tbody>
        </table>
        <h3 id="form_background">Please list any other institutes you represent in Australia:</h3>
        <table>
            <tbody>
                <tr>
                    <td class="textarea">{{ $represent_australia }}</td>

                </tr>
            </tbody>
        </table>
        <p id="form_background">Is your company involved in any other activities?: <input type="checkbox" id=""
                name="" value="">
            <label for=""> Yes</label>
            @if ($activities == 'yes')
                <input type="checkbox" checked />
            @else
                <input type="checkbox" />
            @endif

            <label for=""> No</label>
            @if ($activities == 'no')
                <input type="checkbox" checked />
            @else
                <input type="checkbox" />
            @endif

            <br>
            If yes, please explain?
        </p>
        <table>
            <tbody>
                <tr>
                    <td class="textarea">
                    </td>
                </tr>
            </tbody>
        </table>
        <p id="form_background">Are you accredited to act as an education agent in your country? <input type="checkbox"
                id="" name="" value="">
            <label for=""> Yes</label>
            @if ($education_agent_yes_or_no == 'yes')
                <input type="checkbox" checked />
            @else
                <input type="checkbox" />
            @endif

            <label for=""> No</label>
            @if ($education_agent_yes_or_no == 'no')
                <input type="checkbox" checked />
            @else
                <input type="checkbox" />
            @endif

            <br>
            <small><i>(applicant from the People’s republic of china must provide evidence that they hold a license to
                    act as a registered agent, or have a contract with a registered license holder)</i></small><br>
            If Yes, please provide details:
        </p>
        <table>
            <tbody>
                <tr>
                    <td class="textarea">
                        {{ $if_yes_provide_details }}
                    </td>
                </tr>
            </tbody>
        </table>
        <p id="form_background">What is the most suitable time of the year to conduct a marketing trip to your region or
            a visit to your office to recruit
            students?
        </p>
        <table>
            <tbody>
                <tr>
                    <td class="textarea">
                        {{ $suitable_time_student }}

                    </td>
                </tr>
            </tbody>
        </table>
        <p id="form_background">Do you assist students while in Australia<input type="checkbox" id=""
                name="" value="">
            <label for=""> Yes</label>
            @if ($assist == 'yes')
                <input type="checkbox" checked />
            @else
                <input type="checkbox" />
            @endif

            <label for=""> No</label>
            @if ($assist == 'no')
                <input type="checkbox" checked />
            @else
                <input type="checkbox" />
            @endif

            <br>
        </p>
        <p id="form_background2">If yes, please select<input type="checkbox" id="" name=""
                value="">
            <label for="">through an office in Australia</label> <input type="checkbox" id=""
                name="" value="">
            <label for="">Through an overseas office</label><br>
        </p>
        <h3 style="background-color: orange; padding: 3px; border: 1px solid black;">References:</h3>
        <p id="form_background2">Please provide two referees details (Australian Business)
        </p>
        <p id="form_background">Referee 1:
        </p>
        <table>
            <tbody>
                <tr>
                    <td id="form_background">Company Name:</td>
                    <td>{{ $referee_company_name }}</td>

                    <td id="form_background">Contact Person:</td>
                    <td>{{ $referee_contact_person }}</td>

                </tr>
                <tr>
                    <td id="form_background">Phone:</td>
                    <td>{{ $referee_phone }}</td>

                    <td id="form_background">Position:</td>
                    <td>{{ $referee_position }}</td>

                </tr>
                <tr>
                    <td id="form_background">Address:</td>
                    <td>{{ $referee_address }}</td>

                    <td id="form_background">Email:</td>
                    <td>{{ $referee_email }}</td>

                </tr>
            </tbody>
        </table>
        <p id="form_background">Referee 2:
        </p>
        <table>
            <tbody>
                <tr>
                    <td id="form_background">Company Name:</td>
                    <td>{{ $referee_two_company_name }}</td>

                    <td id="form_background">Contact Person:</td>
                    <td>{{ $referee_two_contact_person }}</td>

                </tr>
                <tr>
                    <td id="form_background">Phone:</td>
                    <td>{{ $referee_two_phone }}</td>

                    <td id="form_background">Position:</td>
                    <td>{{ $referee_two_position }}</td>

                </tr>
                <tr>
                    <td id="form_background">Address:</td>
                    <td>{{ $referee_two_address }}</td>

                    <td id="form_background">Email:</td>
                    <td>{{ $referee_two_email }}</td>

                </tr>
            </tbody>
        </table>
        <h3 style="background-color: orange; padding: 3px; border: 1px solid black;">Agent Bank Details:</h3>
        <p id="form_background2">Please complete your bank account details below into which you wish the commission
            payments to be made. If there is any change in Bank Account details, please advise us in advance.
        </p>
        <table>
            <tbody>
                <tr>
                    <td id="form_background">Financial Institution Name:</td>
                    <td>{{ $financial_institution_name }}</td>

                </tr>
                <tr>
                    <td id="form_background">Financial Institution Name:</td>
                    <td>{{ $financial_institution_name }}</td>

                </tr>
                <tr>
                    <td id="form_background">Bank Address:</td>
                    <td>{{ $agent_bank_address }}</td>

                </tr>
                <tr>
                    <td id="form_background">Name of Bank Account:</td>
                    <td>{{ $agent_bank_account_name }}</td>

                </tr>
                <tr>
                    <td id="form_background">SWIFT Code:</td>
                    <td>{{ $swift_code }}</td>

                </tr>
                <tr>
                    <td id="form_background">BSB Code:</td>
                    <td>{{ $bsb_code }}</td>

                </tr>
                <tr>
                    <td id="form_background">Account Number:</td>
                    <td>{{ $account_number_agent }}</td>

                </tr>

            </tbody>
        </table>
        <h3 style="background-color: orange; padding: 3px; border: 1px solid black;">Declaration:</h3>
        <p id="form_background2">
            Please sign the declaration below:<br>
            I understand that Institute of Business and Management (Victoria) is not under any obligation to accept my
            application to act as an agent to recruit students on their behalf. understand that if my application to
            become an
            agent of Institute of Business and Management (Victoria) is successful, I will be required to enter into and
            abide by a
            formal agency agreement.<br>
            I confirm that I have all the necessary registrations, accreditations and permissions to act as an education
            agent in all
            the territories which I have nominated, and understand that I must notify the institute if any changes occur
            in the
            registration status of my agency.<br>
            I have read, understand and agree to abide by the terms and conditions of the institute’s privacy
            policy.<br>
            I consent to Institute of Business and Management (Victoria) to contact any of the referees I have
            nominated.<br>
            I undertake that the above information provided in this application is a true and accurate record as to the
            operation of the educational agency I represent.<br>
            <br>
            By returning this application to Institute of Business and Management (Victoria), I agree to abide by the
            terms and
            conditions in the mentioned declaration.<br>
            Address & Contact for notices:<br>
            60 Belfast Street, Broadmeadows, VIC, 3047.<br>
            Phone: +61 3 94783163<br>
            Email: info@ibm.vic.edu.au<br>
            Website: https://ibm.vic.edu.au
        </p>
        <table>
            <tbody>
                <tr>
                    <td id="form_background">Name of Officer/ Agent:</td>
                    <td>{{ $name_of_the_officer }}</td>

                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td id="form_background">Signature of Officer/ Agent:</td>
                    <td></td>
                    <td id="form_background">Date:</td>
                    <td><img style="width:50px;height:30px; padding:5px;" src="{{ $signature }}" /></td>

                </tr>
            </tbody>
        </table>
        <h3 style="background-color: orange; padding: 3px; border: 1px solid black; text-align: center;">OFFICE USE
            ONLY</h3>
        <table>
            <tbody>
                <tr>
                    <td id="form_background">Applicant Request</td>
                    <td><input type="checkbox" id="" name="" value="">
                        <label for=""> Approved</label> <input type="checkbox" id="" name=""
                            value="">
                        <label for=""> Declined</label><br>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td id="form_background">Institute of Business and Management (Victoria)’s Signature:</td>
                    <td></td>
                    <td id="form_background">Date:</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>
        <p>
            <small><i>Expression of interest – Education Agent,</i></small><br>
            <small><i>Learning Victoria Pty Ltd T/As Institute of Business and Management (Victoria)</i></small>
        </p>

    </section>

</body>

</html>
