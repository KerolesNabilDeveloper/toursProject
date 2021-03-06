<?php

function listCountryCodes()
{
    return ["BD" => "Bangladesh", "BE" => "Belgium", "BF" => "Burkina Faso", "BG" => "Bulgaria", "BA" => "Bosnia and Herzegovina", "BB" => "Barbados", "WF" => "Wallis and Futuna", "BL" => "Saint Barthelemy", "BM" => "Bermuda", "BN" => "Brunei", "BO" => "Bolivia", "BH" => "Bahrain", "BI" => "Burundi", "BJ" => "Benin", "BT" => "Bhutan", "JM" => "Jamaica", "BV" => "Bouvet Island", "BW" => "Botswana", "WS" => "Samoa", "BQ" => "Bonaire, Saint Eustatius and Saba ", "BR" => "Brazil", "BS" => "Bahamas", "JE" => "Jersey", "BY" => "Belarus", "BZ" => "Belize", "RU" => "Russia", "RW" => "Rwanda", "RS" => "Serbia", "TL" => "East Timor", "RE" => "Reunion", "TM" => "Turkmenistan", "TJ" => "Tajikistan", "RO" => "Romania", "TK" => "Tokelau", "GW" => "Guinea-Bissau", "GU" => "Guam", "GT" => "Guatemala", "GS" => "South Georgia and the South Sandwich Islands", "GR" => "Greece", "GQ" => "Equatorial Guinea", "GP" => "Guadeloupe", "JP" => "Japan", "GY" => "Guyana", "GG" => "Guernsey", "GF" => "French Guiana", "GE" => "Georgia", "GD" => "Grenada", "GB" => "United Kingdom", "GA" => "Gabon", "SV" => "El Salvador", "GN" => "Guinea", "GM" => "Gambia", "GL" => "Greenland", "GI" => "Gibraltar", "GH" => "Ghana", "OM" => "Oman", "TN" => "Tunisia", "JO" => "Jordan", "HR" => "Croatia", "HT" => "Haiti", "HU" => "Hungary", "HK" => "Hong Kong", "HN" => "Honduras", "HM" => "Heard Island and McDonald Islands", "VE" => "Venezuela", "PR" => "Puerto Rico", "PS" => "Palestinian Territory", "PW" => "Palau", "PT" => "Portugal", "SJ" => "Svalbard and Jan Mayen", "PY" => "Paraguay", "IQ" => "Iraq", "PA" => "Panama", "PF" => "French Polynesia", "PG" => "Papua New Guinea", "PE" => "Peru", "PK" => "Pakistan", "PH" => "Philippines", "PN" => "Pitcairn", "PL" => "Poland", "PM" => "Saint Pierre and Miquelon", "ZM" => "Zambia", "EH" => "Western Sahara", "EE" => "Estonia", "EG" => "Egypt", "ZA" => "South Africa", "EC" => "Ecuador", "IT" => "Italy", "VN" => "Vietnam", "SB" => "Solomon Islands", "ET" => "Ethiopia", "SO" => "Somalia", "ZW" => "Zimbabwe", "SA" => "Saudi Arabia", "ES" => "Spain", "ER" => "Eritrea", "ME" => "Montenegro", "MD" => "Moldova", "MG" => "Madagascar", "MF" => "Saint Martin", "MA" => "Morocco", "MC" => "Monaco", "UZ" => "Uzbekistan", "MM" => "Myanmar", "ML" => "Mali", "MO" => "Macao", "MN" => "Mongolia", "MH" => "Marshall Islands", "MK" => "Macedonia", "MU" => "Mauritius", "MT" => "Malta", "MW" => "Malawi", "MV" => "Maldives", "MQ" => "Martinique", "MP" => "Northern Mariana Islands", "MS" => "Montserrat", "MR" => "Mauritania", "IM" => "Isle of Man", "UG" => "Uganda", "TZ" => "Tanzania", "MY" => "Malaysia", "MX" => "Mexico", "IL" => "Israel", "FR" => "France", "IO" => "British Indian Ocean Territory", "SH" => "Saint Helena", "FI" => "Finland", "FJ" => "Fiji", "FK" => "Falkland Islands", "FM" => "Micronesia", "FO" => "Faroe Islands", "NI" => "Nicaragua", "NL" => "Netherlands", "NO" => "Norway", "NA" => "Namibia", "VU" => "Vanuatu", "NC" => "New Caledonia", "NE" => "Niger", "NF" => "Norfolk Island", "NG" => "Nigeria", "NZ" => "New Zealand", "NP" => "Nepal", "NR" => "Nauru", "NU" => "Niue", "CK" => "Cook Islands", "XK" => "Kosovo", "CI" => "Ivory Coast", "CH" => "Switzerland", "CO" => "Colombia", "CN" => "China", "CM" => "Cameroon", "CL" => "Chile", "CC" => "Cocos Islands", "CA" => "Canada", "CG" => "Republic of the Congo", "CF" => "Central African Republic", "CD" => "Democratic Republic of the Congo", "CZ" => "Czech Republic", "CY" => "Cyprus", "CX" => "Christmas Island", "CR" => "Costa Rica", "CW" => "Curacao", "CV" => "Cape Verde", "CU" => "Cuba", "SZ" => "Swaziland", "SY" => "Syria", "SX" => "Sint Maarten", "KG" => "Kyrgyzstan", "KE" => "Kenya", "SS" => "South Sudan", "SR" => "Suriname", "KI" => "Kiribati", "KH" => "Cambodia", "KN" => "Saint Kitts and Nevis", "KM" => "Comoros", "ST" => "Sao Tome and Principe", "SK" => "Slovakia", "KR" => "South Korea", "SI" => "Slovenia", "KP" => "North Korea", "KW" => "Kuwait", "SN" => "Senegal", "SM" => "San Marino", "SL" => "Sierra Leone", "SC" => "Seychelles", "KZ" => "Kazakhstan", "KY" => "Cayman Islands", "SG" => "Singapore", "SE" => "Sweden", "SD" => "Sudan", "DO" => "Dominican Republic", "DM" => "Dominica", "DJ" => "Djibouti", "DK" => "Denmark", "VG" => "British Virgin Islands", "DE" => "Germany", "YE" => "Yemen", "DZ" => "Algeria", "US" => "United States", "UY" => "Uruguay", "YT" => "Mayotte", "UM" => "United States Minor Outlying Islands", "LB" => "Lebanon", "LC" => "Saint Lucia", "LA" => "Laos", "TV" => "Tuvalu", "TW" => "Taiwan", "TT" => "Trinidad and Tobago", "TR" => "Turkey", "LK" => "Sri Lanka", "LI" => "Liechtenstein", "LV" => "Latvia", "TO" => "Tonga", "LT" => "Lithuania", "LU" => "Luxembourg", "LR" => "Liberia", "LS" => "Lesotho", "TH" => "Thailand", "TF" => "French Southern Territories", "TG" => "Togo", "TD" => "Chad", "TC" => "Turks and Caicos Islands", "LY" => "Libya", "VA" => "Vatican", "VC" => "Saint Vincent and the Grenadines", "AE" => "United Arab Emirates", "AD" => "Andorra", "AG" => "Antigua and Barbuda", "AF" => "Afghanistan", "AI" => "Anguilla", "VI" => "U.S. Virgin Islands", "IS" => "Iceland", "IR" => "Iran", "AM" => "Armenia", "AL" => "Albania", "AO" => "Angola", "AQ" => "Antarctica", "AS" => "American Samoa", "AR" => "Argentina", "AU" => "Australia", "AT" => "Austria", "AW" => "Aruba", "IN" => "India", "AX" => "Aland Islands", "AZ" => "Azerbaijan", "IE" => "Ireland", "ID" => "Indonesia", "UA" => "Ukraine", "QA" => "Qatar", "MZ" => "Mozambique"];
}

function listPhoneCodes()
{

    return [
        'ANDORRA (+376)'                                    => 376,
        'UNITED ARAB EMIRATES (+971)'                       => 971,
        'AFGHANISTAN (+93)'                                 => 93,
        'ANTIGUA AND BARBUDA (+1268)'                       => 1268,
        'ANGUILLA (+1264)'                                  => 1264,
        'ALBANIA (+355)'                                    => 355,
        'ARMENIA (+374)'                                    => 374,
        'NETHERLANDS ANTILLES (+599)'                       => 599,
        'ANGOLA (+244)'                                     => 244,
        'ANTARCTICA (+672)'                                 => 672,
        'ARGENTINA (+54)'                                   => 54,
        'AMERICAN SAMOA (+1684)'                            => 1684,
        'AUSTRIA (+43)'                                     => 43,
        'AUSTRALIA (+61)'                                   => 61,
        'ARUBA (+297)'                                      => 297,
        'AZERBAIJAN (+994)'                                 => 994,
        'BOSNIA AND HERZEGOVINA (+387)'                     => 387,
        'BARBADOS (+1246)'                                  => 1246,
        'BANGLADESH (+880)'                                 => 880,
        'BELGIUM (+32)'                                     => 32,
        'BURKINA FASO (+226)'                               => 226,
        'BULGARIA (+359)'                                   => 359,
        'BAHRAIN (+973)'                                    => 973,
        'BURUNDI (+257)'                                    => 257,
        'BENIN (+229)'                                      => 229,
        'SAINT BARTHELEMY (+590)'                           => 590,
        'BERMUDA (+1441)'                                   => 1441,
        'BRUNEI DARUSSALAM (+673)'                          => 673,
        'BOLIVIA (+591)'                                    => 591,
        'BRAZIL (+55)'                                      => 55,
        'BAHAMAS (+1242)'                                   => 1242,
        'BHUTAN (+975)'                                     => 975,
        'BOTSWANA (+267)'                                   => 267,
        'BELARUS (+375)'                                    => 375,
        'BELIZE (+501)'                                     => 501,
        'CANADA (+1)'                                       => 1,
        'COCOS (KEELING) ISLANDS (+61)'                     => 61,
        'CONGO, THE DEMOCRATIC REPUBLIC OF THE (+243)'      => 243,
        'CENTRAL AFRICAN REPUBLIC (+236)'                   => 236,
        'CONGO (+242)'                                      => 242,
        'SWITZERLAND (+41)'                                 => 41,
        'COTE D IVOIRE (+225)'                              => 225,
        'COOK ISLANDS (+682)'                               => 682,
        'CHILE (+56)'                                       => 56,
        'CAMEROON (+237)'                                   => 237,
        'CHINA (+86)'                                       => 86,
        'COLOMBIA (+57)'                                    => 57,
        'COSTA RICA (+506)'                                 => 506,
        'CUBA (+53)'                                        => 53,
        'CAPE VERDE (+238)'                                 => 238,
        'CHRISTMAS ISLAND (+61)'                            => 61,
        'CYPRUS (+357)'                                     => 357,
        'CZECH REPUBLIC (+420)'                             => 420,
        'GERMANY (+49)'                                     => 49,
        'DJIBOUTI (+253)'                                   => 253,
        'DENMARK (+45)'                                     => 45,
        'DOMINICA (+1767)'                                  => 1767,
        'DOMINICAN REPUBLIC (+1809)'                        => 1809,
        'ALGERIA (+213)'                                    => 213,
        'ECUADOR (+593)'                                    => 593,
        'ESTONIA (+372)'                                    => 372,
        'EGYPT (+20)'                                       => 20,
        'ERITREA (+291)'                                    => 291,
        'SPAIN (+34)'                                       => 34,
        'ETHIOPIA (+251)'                                   => 251,
        'FINLAND (+358)'                                    => 358,
        'FIJI (+679)'                                       => 679,
        'FALKLAND ISLANDS (MALVINAS) (+500)'                => 500,
        'MICRONESIA, FEDERATED STATES OF (+691)'            => 691,
        'FAROE ISLANDS (+298)'                              => 298,
        'FRANCE (+33)'                                      => 33,
        'GABON (+241)'                                      => 241,
        'UNITED KINGDOM (+44)'                              => 44,
        'GRENADA (+1473)'                                   => 1473,
        'GEORGIA (+995)'                                    => 995,
        'GHANA (+233)'                                      => 233,
        'GIBRALTAR (+350)'                                  => 350,
        'GREENLAND (+299)'                                  => 299,
        'GAMBIA (+220)'                                     => 220,
        'GUINEA (+224)'                                     => 224,
        'EQUATORIAL GUINEA (+240)'                          => 240,
        'GREECE (+30)'                                      => 30,
        'GUATEMALA (+502)'                                  => 502,
        'GUAM (+1671)'                                      => 1671,
        'GUINEA-BISSAU (+245)'                              => 245,
        'GUYANA (+592)'                                     => 592,
        'HONG KONG (+852)'                                  => 852,
        'HONDURAS (+504)'                                   => 504,
        'CROATIA (+385)'                                    => 385,
        'HAITI (+509)'                                      => 509,
        'HUNGARY (+36)'                                     => 36,
        'INDONESIA (+62)'                                   => 62,
        'IRELAND (+353)'                                    => 353,
        'ISRAEL (+972)'                                     => 972,
        'ISLE OF MAN (+44)'                                 => 44,
        'INDIA (+91)'                                       => 91,
        'IRAQ (+964)'                                       => 964,
        'IRAN, ISLAMIC REPUBLIC OF (+98)'                   => 98,
        'ICELAND (+354)'                                    => 354,
        'ITALY (+39)'                                       => 39,
        'JAMAICA (+1876)'                                   => 1876,
        'JORDAN (+962)'                                     => 962,
        'JAPAN (+81)'                                       => 81,
        'KENYA (+254)'                                      => 254,
        'KYRGYZSTAN (+996)'                                 => 996,
        'CAMBODIA (+855)'                                   => 855,
        'KIRIBATI (+686)'                                   => 686,
        'COMOROS (+269)'                                    => 269,
        'SAINT KITTS AND NEVIS (+1869)'                     => 1869,
        'KOREA DEMOCRATIC PEOPLES REPUBLIC OF (+850)'       => 850,
        'KOREA REPUBLIC OF (+82)'                           => 82,
        'KUWAIT (+965)'                                     => 965,
        'CAYMAN ISLANDS (+1345)'                            => 1345,
        'KAZAKSTAN (+7)'                                    => 7,
        'LAO PEOPLES DEMOCRATIC REPUBLIC (+856)'            => 856,
        'LEBANON (+961)'                                    => 961,
        'SAINT LUCIA (+1758)'                               => 1758,
        'LIECHTENSTEIN (+423)'                              => 423,
        'SRI LANKA (+94)'                                   => 94,
        'LIBERIA (+231)'                                    => 231,
        'LESOTHO (+266)'                                    => 266,
        'LITHUANIA (+370)'                                  => 370,
        'LUXEMBOURG (+352)'                                 => 352,
        'LATVIA (+371)'                                     => 371,
        'LIBYAN ARAB JAMAHIRIYA (+218)'                     => 218,
        'MOROCCO (+212)'                                    => 212,
        'MONACO (+377)'                                     => 377,
        'MOLDOVA, REPUBLIC OF (+373)'                       => 373,
        'MONTENEGRO (+382)'                                 => 382,
        'SAINT MARTIN (+1599)'                              => 1599,
        'MADAGASCAR (+261)'                                 => 261,
        'MARSHALL ISLANDS (+692)'                           => 692,
        'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF (+389)' => 389,
        'MALI (+223)'                                       => 223,
        'MYANMAR (+95)'                                     => 95,
        'MONGOLIA (+976)'                                   => 976,
        'MACAU (+853)'                                      => 853,
        'NORTHERN MARIANA ISLANDS (+1670)'                  => 1670,
        'MAURITANIA (+222)'                                 => 222,
        'MONTSERRAT (+1664)'                                => 1664,
        'MALTA (+356)'                                      => 356,
        'MAURITIUS (+230)'                                  => 230,
        'MALDIVES (+960)'                                   => 960,
        'MALAWI (+265)'                                     => 265,
        'MEXICO (+52)'                                      => 52,
        'MALAYSIA (+60)'                                    => 60,
        'MOZAMBIQUE (+258)'                                 => 258,
        'NAMIBIA (+264)'                                    => 264,
        'NEW CALEDONIA (+687)'                              => 687,
        'NIGER (+227)'                                      => 227,
        'NIGERIA (+234)'                                    => 234,
        'NICARAGUA (+505)'                                  => 505,
        'NETHERLANDS (+31)'                                 => 31,
        'NORWAY (+47)'                                      => 47,
        'NEPAL (+977)'                                      => 977,
        'NAURU (+674)'                                      => 674,
        'NIUE (+683)'                                       => 683,
        'NEW ZEALAND (+64)'                                 => 64,
        'OMAN (+968)'                                       => 968,
        'PANAMA (+507)'                                     => 507,
        'PERU (+51)'                                        => 51,
        'FRENCH POLYNESIA (+689)'                           => 689,
        'PAPUA NEW GUINEA (+675)'                           => 675,
        'PHILIPPINES (+63)'                                 => 63,
        'PAKISTAN (+92)'                                    => 92,
        'POLAND (+48)'                                      => 48,
        'SAINT PIERRE AND MIQUELON (+508)'                  => 508,
        'PITCAIRN (+870)'                                   => 870,
        'PUERTO RICO (+1)'                                  => 1,
        'PORTUGAL (+351)'                                   => 351,
        'PALAU (+680)'                                      => 680,
        'PARAGUAY (+595)'                                   => 595,
        'QATAR (+974)'                                      => 974,
        'ROMANIA (+40)'                                     => 40,
        'SERBIA (+381)'                                     => 381,
        'RUSSIAN FEDERATION (+7)'                           => 7,
        'RWANDA (+250)'                                     => 250,
        'SAUDI ARABIA (+966)'                               => 966,
        'SOLOMON ISLANDS (+677)'                            => 677,
        'SEYCHELLES (+248)'                                 => 248,
        'SUDAN (+249)'                                      => 249,
        'SWEDEN (+46)'                                      => 46,
        'SINGAPORE (+65)'                                   => 65,
        'SAINT HELENA (+290)'                               => 290,
        'SLOVENIA (+386)'                                   => 386,
        'SLOVAKIA (+421)'                                   => 421,
        'SIERRA LEONE (+232)'                               => 232,
        'SAN MARINO (+378)'                                 => 378,
        'SENEGAL (+221)'                                    => 221,
        'SOMALIA (+252)'                                    => 252,
        'SURINAME (+597)'                                   => 597,
        'SAO TOME AND PRINCIPE (+239)'                      => 239,
        'EL SALVADOR (+503)'                                => 503,
        'SYRIAN ARAB REPUBLIC (+963)'                       => 963,
        'SWAZILAND (+268)'                                  => 268,
        'TURKS AND CAICOS ISLANDS (+1649)'                  => 1649,
        'CHAD (+235)'                                       => 235,
        'TOGO (+228)'                                       => 228,
        'THAILAND (+66)'                                    => 66,
        'TAJIKISTAN (+992)'                                 => 992,
        'TOKELAU (+690)'                                    => 690,
        'TIMOR-LESTE (+670)'                                => 670,
        'TURKMENISTAN (+993)'                               => 993,
        'TUNISIA (+216)'                                    => 216,
        'TONGA (+676)'                                      => 676,
        'TURKEY (+90)'                                      => 90,
        'TRINIDAD AND TOBAGO (+1868)'                       => 1868,
        'TUVALU (+688)'                                     => 688,
        'TAIWAN, PROVINCE OF CHINA (+886)'                  => 886,
        'TANZANIA, UNITED REPUBLIC OF (+255)'               => 255,
        'UKRAINE (+380)'                                    => 380,
        'UGANDA (+256)'                                     => 256,
        'UNITED STATES (+1)'                                => 1,
        'URUGUAY (+598)'                                    => 598,
        'UZBEKISTAN (+998)'                                 => 998,
        'HOLY SEE (VATICAN CITY STATE) (+39)'               => 39,
        'SAINT VINCENT AND THE GRENADINES (+1784)'          => 1784,
        'VENEZUELA (+58)'                                   => 58,
        'VIRGIN ISLANDS, BRITISH (+1284)'                   => 1284,
        'VIRGIN ISLANDS, U.S. (+1340)'                      => 1340,
        'VIET NAM (+84)'                                    => 84,
        'VANUATU (+678)'                                    => 678,
        'WALLIS AND FUTUNA (+681)'                          => 681,
        'SAMOA (+685)'                                      => 685,
        'KOSOVO (+381)'                                     => 381,
        'YEMEN (+967)'                                      => 967,
        'MAYOTTE (+262)'                                    => 262,
        'SOUTH AFRICA (+27)'                                => 27,
        'ZAMBIA (+260)'                                     => 260,
        'ZIMBABWE (+263)'                                   => 263,
    ];

}
