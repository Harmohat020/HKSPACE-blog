# FakeDataPHP

PHP library that generates fake data for you

http://www.getsourcecodes.com

Generate dummy data in php

Faker is a PHP library that generates fake data for you. Whether you need to bootstrap your database, create good-looking XML documents, fill-in your persistence to stress test it, or anonymize data taken from a production service, Faker is for you.

Below Referece for generating different types of dummt data in mysql

Ex : $faker->randomDigit

randomDigit             // 7

randomDigitNotNull      // 5

randomNumber($nbDigits = NULL, $strict = false) // 79907610

randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL) // 48.8932

numberBetween($min = 1000, $max = 9000) // 8567

randomLetter            // 'b'

// returns randomly ordered subsequence of a provided array

randomElements($array = array ('a','b','c'), $count = 1) // array('c')

randomElement($array = array ('a','b','c')) // 'b'

shuffle('hello, world') // 'rlo,h eoldlw'

shuffle(array(1, 2, 3)) // array(2, 1, 3)

numerify('Hello ###') // 'Hello 609'

lexify('Hello ???') // 'Hello wgt'

bothify('Hello ##??') // 'Hello 42jz'

asciify('Hello ***') // 'Hello R6+'

regexify('[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}'); // sm0@y8k96a.ej

word                                             // 'aut'

words($nb = 3, $asText = false)                  // array('porro', 'sed', 'magni')

sentence($nbWords = 6, $variableNbWords = true)  // 'Sit vitae voluptas sint non voluptates.'

sentences($nb = 3, $asText = false)              // array('Optio quos qui illo error.', 'Laborum vero a officia id corporis.', 'Saepe provident esse hic eligendi.')

paragraph($nbSentences = 3, $variableNbSentences = true) // 'Ut ab voluptas sed a nam. Sint autem inventore aut officia aut aut blanditiis. Ducimus eos odit amet et est ut eum.'

paragraphs($nb = 3, $asText = false)             // array('Quidem ut sunt et quidem est accusamus aut. Fuga est placeat rerum ut. Enim ex eveniet facere sunt.', 'Aut nam et eum architecto fugit repellendus illo. Qui ex esse veritatis.', 'Possimus omnis aut incidunt sunt. Asperiores incidunt iure sequi cum culpa rem. Rerum exercitationem est rem.')

text($maxNbChars = 200)                          // 'Fuga totam reiciendis qui architecto fugiat nemo. Consequatur recusandae qui cupiditate eos quod.'

title($gender = null|'male'|'female')     // 'Ms.'

titleMale                                 // 'Mr.'

titleFemale                               // 'Ms.'

suffix                                    // 'Jr.'

name($gender = null|'male'|'female')      // 'Dr. Zane Stroman'

firstName($gender = null|'male'|'female') // 'Maynard'

firstNameMale                             // 'Maynard'

firstNameFemale                           // 'Rachel'

lastName                                  // 'Zulauf'

cityPrefix                          // 'Lake'

secondaryAddress                    // 'Suite 961'

state                               // 'NewMexico'

stateAbbr                           // 'OH'

citySuffix                          // 'borough'

streetSuffix                        // 'Keys'

buildingNumber                      // '484'

city                                // 'West Judge'

streetName                          // 'Keegan Trail'

streetAddress                       // '439 Karley Loaf Suite 897'

postcode                            // '17916'

address                             // '8888 Cummings Vista Apt. 101, Susanbury, NY 95473'

country                             // 'Falkland Islands (Malvinas)'

latitude($min = -90, $max = 90)     // 77.147489

longitude($min = -180, $max = 180)  // 86.211205

phoneNumber             // '201-886-0269 x3767'

tollFreePhoneNumber     // '(888) 937-7238'

e164PhoneNumber     // '+27113456789'

catchPhrase             // 'Monitored regional contingency'

bs                      // 'e-enable robust architectures'

company                 // 'Bogan-Treutel'

companySuffix           // 'and Sons'

jobTitle                // 'Cashier'

unixTime($max = 'now')                // 58781813

dateTime($max = 'now', $timezone = null) // DateTime('2008-04-25 08:37:17', 'UTC')

dateTimeAD($max = 'now', $timezone = null) // DateTime('1800-04-29 20:38:49', 'Europe/Paris')

iso8601($max = 'now')                 // '1978-12-09T10:10:29+0000'

date($format = 'Y-m-d', $max = 'now') // '1979-06-09'

time($format = 'H:i:s', $max = 'now') // '20:49:42'

dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null) // DateTime('2003-03-15 02:00:49', 'Africa/Lagos')

dateTimeInInterval($startDate = '-30 years', $interval = '+ 5 days', $timezone = null) // DateTime('2003-03-15 02:00:49', 
'Antartica/Vostok')

dateTimeThisCentury($max = 'now', $timezone = null)     // DateTime('1915-05-30 19:28:21', 'UTC')

dateTimeThisDecade($max = 'now', $timezone = null)      // DateTime('2007-05-29 22:30:48', 'Europe/Paris')

dateTimeThisYear($max = 'now', $timezone = null)        // DateTime('2011-02-27 20:52:14', 'Africa/Lagos')

dateTimeThisMonth($max = 'now', $timezone = null)       // DateTime('2011-10-23 13:46:23', 'Antarctica/Vostok')

amPm($max = 'now')                    // 'pm'

dayOfMonth($max = 'now')              // '04'

dayOfWeek($max = 'now')               // 'Friday'

month($max = 'now')                   // '06'

monthName($max = 'now')               // 'January'

year($max = 'now')                    // '1993'

century                               // 'VI'

timezone                              // 'Europe/Paris'

email                   // 'tkshlerin@collins.com'

safeEmail               // 'king.alford@example.org'

freeEmail               // 'bradley72@gmail.com'

companyEmail            // 'russel.durward@mcdermott.org'

freeEmailDomain         // 'yahoo.com'

safeEmailDomain         // 'example.org'

userName                // 'wade55'

password                // 'k&|X+a45*2['

domainName              // 'wolffdeckow.net'

domainWord              // 'feeney'

tld                     // 'biz'

url                     // 'http://www.skilesdonnelly.biz/aut-accusantium-ut-architecto-sit-et.html'

slug                    // 'aut-repellat-commodi-vel-itaque-nihil-id-saepe-nostrum'

ipv4                    // '109.133.32.252'

localIpv4               // '10.242.58.8'

ipv6                    // '8e65:933d:22ee:a232:f1c1:2741:1f10:117c'

macAddress              // '43:85:B7:08:10:CA'

userAgent              // 'Mozilla/5.0 (Windows CE) AppleWebKit/5350 (KHTML, like Gecko) Chrome/13.0.888.0 Safari/5350'

chrome                 // 'Mozilla/5.0 (Macintosh; PPC Mac OS X 10_6_5) AppleWebKit/5312 (KHTML, like Gecko) Chrome/14.0.894.0 Safari/5312'

firefox                // 'Mozilla/5.0 (X11; Linuxi686; rv:7.0) Gecko/20101231 Firefox/3.6'

safari                 // 'Mozilla/5.0 (Macintosh; U; PPC Mac OS X 10_7_1 rv:3.0; en-US) AppleWebKit/534.11.3 (KHTML, like Gecko) Version/4.0 Safari/534.11.3'

opera                  // 'Opera/8.25 (Windows NT 5.1; en-US) Presto/2.9.188 Version/10.00'

internetExplorer       // 'Mozilla/5.0 (compatible; MSIE 7.0; Windows 98; Win 9x 4.90; Trident/3.0)'

creditCardType          // 'MasterCard'

creditCardNumber        // '4485480221084675'

creditCardExpirationDate // 04/13

creditCardExpirationDateString // '04/13'

creditCardDetails       // array('MasterCard', '4485480221084675', 'Aleksander Nowak', '04/13')

// Generates a random IBAN. Set $countryCode to null for a random country

iban($countryCode)      // 'IT31A8497112740YZ575DJ28BP4'

swiftBicNumber          // 'RZTIAT22263'
