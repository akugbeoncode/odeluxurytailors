<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
			[
				'code' => 'AF',
				'name' => "Afghanistan",
				'phonecode' => 93, 
                'flag' => asset('storage/images/countries/flags/af.svg')
			],[
				'code' => 'AL',
				'name' => "Albania",
				'phonecode' => 355, 
				'flag' => asset('storage/images/countries/flags/al.svg')
			],[
				'code' => 'DZ',
				'name' => "Algeria",
				'phonecode' => 213, 
				'flag' => asset('storage/images/countries/flags/dz.svg')
			],[
				'code' => 'AS',
				'name' => "American Samoa",
				'phonecode' => 1684, 
				'flag' => asset('storage/images/countries/flags/as.svg')
			],[
				'code' => 'AD',
				'name' => "Andorra",
				'phonecode' => 376, 
				'flag' => asset('storage/images/countries/flags/ad.svg')
			],[
				'code' => 'AO',
				'name' => "Angola",
				'phonecode' => 244, 
				'flag' => asset('storage/images/countries/flags/ao.svg')
			],[
				'code' => 'AI',
				'name' => "Anguilla",
				'phonecode' => 1264, 
				'flag' => asset('storage/images/countries/flags/ai.svg')
			],[
				'code' => 'AQ',
				'name' => "Antarctica",
				'phonecode' => 0, 
				'flag' => asset('storage/images/countries/flags/aq.svg')
			],[
				'code' => 'AG',
				'name' => "Antigua And Barbuda",
				'phonecode' => 1268, 
				'flag' => asset('storage/images/countries/flags/ag.svg')
			],[
				'code' => 'AR',
				'name' => "Argentina",
				'phonecode' => 54, 
				'flag' => asset('storage/images/countries/flags/ar.svg')
			],[
				'code' => 'AM',
				'name' => "Armenia",
				'phonecode' => 374, 
				'flag' => asset('storage/images/countries/flags/am.svg')
			],[
				'code' => 'AW',
				'name' => "Aruba",
				'phonecode' => 297, 
				'flag' => asset('storage/images/countries/flags/aw.svg')
			],[
				'code' => 'AU',
				'name' => "Australia",
				'phonecode' => 61, 
				'flag' => asset('storage/images/countries/flags/au.svg')
			],[
				'code' => 'AT',
				'name' => "Austria",
				'phonecode' => 43, 
				'flag' => asset('storage/images/countries/flags/at.svg')
			],[
				'code' => 'AZ',
				'name' => "Azerbaijan",
				'phonecode' => 994, 
				'flag' => asset('storage/images/countries/flags/az.svg')
			],[
				'code' => 'BS',
				'name' => "Bahamas",
				'phonecode' => 1242, 
				'flag' => asset('storage/images/countries/flags/bs.svg')
			],[
				'code' => 'BH',
				'name' => "Bahrain",
				'phonecode' => 973, 
				'flag' => asset('storage/images/countries/flags/bh.svg')
			],[
				'code' => 'BD',
				'name' => "Bangladesh",
				'phonecode' => 880, 
				'flag' => asset('storage/images/countries/flags/bd.svg')
			],[
				'code' => 'BB',
				'name' => "Barbados",
				'phonecode' => 1246, 
				'flag' => asset('storage/images/countries/flags/bb.svg')
			],[
				'code' => 'BY',
				'name' => "Belarus",
				'phonecode' => 375, 
				'flag' => asset('storage/images/countries/flags/by.svg')
			],[
				'code' => 'BE',
				'name' => "Belgium",
				'phonecode' => 32, 
				'flag' => asset('storage/images/countries/flags/be.svg')
			],[
				'code' => 'BZ',
				'name' => "Belize",
				'phonecode' => 501, 
				'flag' => asset('storage/images/countries/flags/bz.svg')
			],[
				'code' => 'BJ',
				'name' => "Benin",
				'phonecode' => 229, 
				'flag' => asset('storage/images/countries/flags/bj.svg')
			],[
				'code' => 'BM',
				'name' => "Bermuda",
				'phonecode' => 1441, 
				'flag' => asset('storage/images/countries/flags/bm.svg')
			],[
				'code' => 'BT',
				'name' => "Bhutan",
				'phonecode' => 975, 
				'flag' => asset('storage/images/countries/flags/bt.svg')
			],[
				'code' => 'BO',
				'name' => "Bolivia",
				'phonecode' => 591, 
				'flag' => asset('storage/images/countries/flags/bo.svg')
			],[
				'code' => 'BA',
				'name' => "Bosnia and Herzegovina",
				'phonecode' => 387, 
				'flag' => asset('storage/images/countries/flags/ba.svg')
			],[
				'code' => 'BW',
				'name' => "Botswana",
				'phonecode' => 267, 
				'flag' => asset('storage/images/countries/flags/bw.svg')
			],[
				'code' => 'BV',
				'name' => "Bouvet Island",
				'phonecode' => 0, 
				'flag' => asset('storage/images/countries/flags/bv.svg')
			],[
				'code' => 'BR',
				'name' => "Brazil",
				'phonecode' => 55, 
				'flag' => asset('storage/images/countries/flags/br.svg')
			],[
				'code' => 'IO',
				'name' => "British Indian Ocean Territory",
				'phonecode' => 246, 
				'flag' => asset('storage/images/countries/flags/io.svg')
			],[
				'code' => 'BN',
				'name' => "Brunei",
				'phonecode' => 673, 
				'flag' => asset('storage/images/countries/flags/bn.svg')
			],[
				'code' => 'BG',
				'name' => "Bulgaria",
				'phonecode' => 359, 
				'flag' => asset('storage/images/countries/flags/bg.svg')
			],[
				'code' => 'BF',
				'name' => "Burkina Faso",
				'phonecode' => 226, 
				'flag' => asset('storage/images/countries/flags/bf.svg')
			],[
				'code' => 'BI',
				'name' => "Burundi",
				'phonecode' => 257, 
				'flag' => asset('storage/images/countries/flags/bi.svg')
			],[
				'code' => 'KH',
				'name' => "Cambodia",
				'phonecode' => 855, 
				'flag' => asset('storage/images/countries/flags/kh.svg')
			],[
				'code' => 'CM',
				'name' => "Cameroon",
				'phonecode' => 237, 
				'flag' => asset('storage/images/countries/flags/cm.svg')
			],[
				'code' => 'CA',
				'name' => "Canada",
				'phonecode' => 1, 
				'flag' => asset('storage/images/countries/flags/ca.svg')
			],[
				'code' => 'CV',
				'name' => "Cape Verde",
				'phonecode' => 238, 
				'flag' => asset('storage/images/countries/flags/cv.svg')
			],[
				'code' => 'KY',
				'name' => "Cayman Islands",
				'phonecode' => 1345, 
				'flag' => asset('storage/images/countries/flags/ky.svg')
			],[
				'code' => 'CF',
				'name' => "Central African Republic",
				'phonecode' => 236, 
				'flag' => asset('storage/images/countries/flags/cf.svg')
			],[
				'code' => 'TD',
				'name' => "Chad",
				'phonecode' => 235, 
				'flag' => asset('storage/images/countries/flags/td.svg')
			],[
				'code' => 'CL',
				'name' => "Chile",
				'phonecode' => 56, 
				'flag' => asset('storage/images/countries/flags/cl.svg')
			],[
				'code' => 'CN',
				'name' => "China",
				'phonecode' => 86, 
				'flag' => asset('storage/images/countries/flags/cn.svg')
			],[
				'code' => 'CX',
				'name' => "Christmas Island",
				'phonecode' => 61, 
				'flag' => asset('storage/images/countries/flags/cx.svg')
			],[
				'code' => 'CC',
				'name' => "Cocos (Keeling) Islands",
				'phonecode' => 672, 
				'flag' => asset('storage/images/countries/flags/cc.svg')
			],[
				'code' => 'CO',
				'name' => "Colombia",
				'phonecode' => 57, 
				'flag' => asset('storage/images/countries/flags/co.svg')
			],[
				'code' => 'KM',
				'name' => "Comoros",
				'phonecode' => 269, 
				'flag' => asset('storage/images/countries/flags/km.svg')
			],[
				'code' => 'CG',
				'name' => "Congo",
				'phonecode' => 242, 
				'flag' => asset('storage/images/countries/flags/cg.svg')
			],[
				'code' => 'CD',
				'name' => "Democratic Republic Of The Congo",
				'phonecode' => 242, 
				'flag' => asset('storage/images/countries/flags/cd.svg')
			],[
				'code' => 'CK',
				'name' => "Cook Islands",
				'phonecode' => 682, 
				'flag' => asset('storage/images/countries/flags/ck.svg')
			],[
				'code' => 'CR',
				'name' => "Costa Rica",
				'phonecode' => 506, 
				'flag' => asset('storage/images/countries/flags/cr.svg')
			],[
				'code' => 'CI',
				'name' => "Cote D Ivoire (Ivory Coast)",
				'phonecode' => 225, 
				'flag' => asset('storage/images/countries/flags/ci.svg')
			],[
				'code' => 'HR',
				'name' => "Croatia",
				'phonecode' => 385, 
				'flag' => asset('storage/images/countries/flags/hr.svg')
			],[
				'code' => 'CU',
				'name' => "Cuba",
				'phonecode' => 53, 
				'flag' => asset('storage/images/countries/flags/cu.svg')
			],[
				'code' => 'CY',
				'name' => "Cyprus",
				'phonecode' => 357, 
				'flag' => asset('storage/images/countries/flags/cy.svg')
			],[
				'code' => 'CZ',
				'name' => "Czech Republic",
				'phonecode' => 420, 
				'flag' => asset('storage/images/countries/flags/cz.svg')
			],[
				'code' => 'DK',
				'name' => "Denmark",
				'phonecode' => 45, 
				'flag' => asset('storage/images/countries/flags/dk.svg')
			],[
				'code' => 'DJ',
				'name' => "Djibouti",
				'phonecode' => 253, 
				'flag' => asset('storage/images/countries/flags/dj.svg')
			],[
				'code' => 'DM',
				'name' => "Dominica",
				'phonecode' => 1767, 
				'flag' => asset('storage/images/countries/flags/dm.svg')
			],[
				'code' => 'DO',
				'name' => "Dominican Republic",
				'phonecode' => 1809, 
				'flag' => asset('storage/images/countries/flags/do.svg')
			],[
				'code' => 'TP',
				'name' => "East Timor",
				'phonecode' => 670, 
				'flag' => asset('storage/images/countries/flags/tp.svg')
			],[
				'code' => 'EC',
				'name' => "Ecuador",
				'phonecode' => 593, 
				'flag' => asset('storage/images/countries/flags/ec.svg')
			],[
				'code' => 'EG',
				'name' => "Egypt",
				'phonecode' => 20, 
				'flag' => asset('storage/images/countries/flags/eg.svg')
			],[
				'code' => 'SV',
				'name' => "El Salvador",
				'phonecode' => 503, 
				'flag' => asset('storage/images/countries/flags/sv.svg')
			],[
				'code' => 'GQ',
				'name' => "Equatorial Guinea",
				'phonecode' => 240, 
				'flag' => asset('storage/images/countries/flags/gq.svg')
			],[
				'code' => 'ER',
				'name' => "Eritrea",
				'phonecode' => 291, 
				'flag' => asset('storage/images/countries/flags/er.svg')
			],[
				'code' => 'EE',
				'name' => "Estonia",
				'phonecode' => 372, 
				'flag' => asset('storage/images/countries/flags/ee.svg')
			],[
				'code' => 'ET',
				'name' => "Ethiopia",
				'phonecode' => 251, 
				'flag' => asset('storage/images/countries/flags/et.svg')
			],[
				'code' => 'XA',
				'name' => "External Territories of Australia",
				'phonecode' => 61, 
				'flag' => asset('storage/images/countries/flags/xa.svg')
			],[
				'code' => 'FK',
				'name' => "Falkland Islands",
				'phonecode' => 500, 
				'flag' => asset('storage/images/countries/flags/fk.svg')
			],[
				'code' => 'FO',
				'name' => "Faroe Islands",
				'phonecode' => 298, 
				'flag' => asset('storage/images/countries/flags/fo.svg')
			],[
				'code' => 'FJ',
				'name' => "Fiji Islands",
				'phonecode' => 679, 
				'flag' => asset('storage/images/countries/flags/fj.svg')
			],[
				'code' => 'FI',
				'name' => "Finland",
				'phonecode' => 358, 
				'flag' => asset('storage/images/countries/flags/fi.svg')
			],[
				'code' => 'FR',
				'name' => "France",
				'phonecode' => 33, 
				'flag' => asset('storage/images/countries/flags/fr.svg')
			],[
				'code' => 'GF',
				'name' => "French Guiana",
				'phonecode' => 594, 
				'flag' => asset('storage/images/countries/flags/gf.svg')
			],[
				'code' => 'PF',
				'name' => "French Polynesia",
				'phonecode' => 689, 
				'flag' => asset('storage/images/countries/flags/pf.svg')
			],[
				'code' => 'TF',
				'name' => "French Southern Territories",
				'phonecode' => 0, 
				'flag' => asset('storage/images/countries/flags/tf.svg')
			],[
				'code' => 'GA',
				'name' => "Gabon",
				'phonecode' => 241, 
				'flag' => asset('storage/images/countries/flags/ga.svg')
			],[
				'code' => 'GM',
				'name' => "Gambia The",
				'phonecode' => 220, 
				'flag' => asset('storage/images/countries/flags/gm.svg')
			],[
				'code' => 'GE',
				'name' => "Georgia",
				'phonecode' => 995, 
				'flag' => asset('storage/images/countries/flags/ge.svg')
			],[
				'code' => 'DE',
				'name' => "Germany",
				'phonecode' => 49, 
				'flag' => asset('storage/images/countries/flags/de.svg')
			],[
				'code' => 'GH',
				'name' => "Ghana",
				'phonecode' => 233, 
				'flag' => asset('storage/images/countries/flags/gh.svg')
			],[
				'code' => 'GI',
				'name' => "Gibraltar",
				'phonecode' => 350, 
				'flag' => asset('storage/images/countries/flags/gi.svg')
			],[
				'code' => 'GR',
				'name' => "Greece",
				'phonecode' => 30, 
				'flag' => asset('storage/images/countries/flags/gr.svg')
			],[
				'code' => 'GL',
				'name' => "Greenland",
				'phonecode' => 299, 
				'flag' => asset('storage/images/countries/flags/gl.svg')
			],[
				'code' => 'GD',
				'name' => "Grenada",
				'phonecode' => 1473, 
				'flag' => asset('storage/images/countries/flags/gd.svg')
			],[
				'code' => 'GP',
				'name' => "Guadeloupe",
				'phonecode' => 590, 
				'flag' => asset('storage/images/countries/flags/gp.svg')
			],[
				'code' => 'GU',
				'name' => "Guam",
				'phonecode' => 1671, 
				'flag' => asset('storage/images/countries/flags/gu.svg')
			],[
				'code' => 'GT',
				'name' => "Guatemala",
				'phonecode' => 502, 
				'flag' => asset('storage/images/countries/flags/gt.svg')
			],[
				'code' => 'XU',
				'name' => "Guernsey and Alderney",
				'phonecode' => 44, 
				'flag' => asset('storage/images/countries/flags/xu.svg')
			],[
				'code' => 'GN',
				'name' => "Guinea",
				'phonecode' => 224, 
				'flag' => asset('storage/images/countries/flags/gn.svg')
			],[
				'code' => 'GW',
				'name' => "Guinea-Bissau",
				'phonecode' => 245, 
				'flag' => asset('storage/images/countries/flags/gw.svg')
			],[
				'code' => 'GY',
				'name' => "Guyana",
				'phonecode' => 592, 
				'flag' => asset('storage/images/countries/flags/gy.svg')
			],[
				'code' => 'HT',
				'name' => "Haiti",
				'phonecode' => 509, 
				'flag' => asset('storage/images/countries/flags/ht.svg')
			],[
				'code' => 'HM',
				'name' => "Heard and McDonald Islands",
				'phonecode' => 0, 
				'flag' => asset('storage/images/countries/flags/hm.svg')
			],[
				'code' => 'HN',
				'name' => "Honduras",
				'phonecode' => 504, 
				'flag' => asset('storage/images/countries/flags/hn.svg')
			],[
				'code' => 'HK',
				'name' => "Hong Kong",
				'phonecode' => 852, 
				'flag' => asset('storage/images/countries/flags/hk.svg')
			],[
				'code' => 'HU',
				'name' => "Hungary",
				'phonecode' => 36, 
				'flag' => asset('storage/images/countries/flags/hu.svg')
			],[
				'code' => 'IS',
				'name' => "Iceland",
				'phonecode' => 354, 
				'flag' => asset('storage/images/countries/flags/is.svg')
			],[
				'code' => 'IN',
				'name' => "India",
				'phonecode' => 91, 
				'flag' => asset('storage/images/countries/flags/in.svg')
			],[
				'code' => 'ID',
				'name' => "Indonesia",
				'phonecode' => 62, 
				'flag' => asset('storage/images/countries/flags/id.svg')
			],[
				'code' => 'IR',
				'name' => "Iran",
				'phonecode' => 98, 
				'flag' => asset('storage/images/countries/flags/ir.svg')
			],[
				'code' => 'IQ',
				'name' => "Iraq",
				'phonecode' => 964, 
				'flag' => asset('storage/images/countries/flags/iq.svg')
			],[
				'code' => 'IE',
				'name' => "Ireland",
				'phonecode' => 353, 
				'flag' => asset('storage/images/countries/flags/ie.svg')
			],[
				'code' => 'IL',
				'name' => "Israel",
				'phonecode' => 972, 
				'flag' => asset('storage/images/countries/flags/il.svg')
			],[
				'code' => 'IT',
				'name' => "Italy",
				'phonecode' => 39, 
				'flag' => asset('storage/images/countries/flags/it.svg')
			],[
				'code' => 'JM',
				'name' => "Jamaica",
				'phonecode' => 1876, 
				'flag' => asset('storage/images/countries/flags/jm.svg')
			],[
				'code' => 'JP',
				'name' => "Japan",
				'phonecode' => 81, 
				'flag' => asset('storage/images/countries/flags/jp.svg')
			],[
				'code' => 'XJ',
				'name' => "Jersey",
				'phonecode' => 44, 
				'flag' => asset('storage/images/countries/flags/xj.svg')
			],[
				'code' => 'JO',
				'name' => "Jordan",
				'phonecode' => 962, 
				'flag' => asset('storage/images/countries/flags/jo.svg')
			],[
				'code' => 'KZ',
				'name' => "Kazakhstan",
				'phonecode' => 7, 
				'flag' => asset('storage/images/countries/flags/kz.svg')
			],[
				'code' => 'KE',
				'name' => "Kenya",
				'phonecode' => 254, 
				'flag' => asset('storage/images/countries/flags/ke.svg')
			],[
				'code' => 'KI',
				'name' => "Kiribati",
				'phonecode' => 686, 
				'flag' => asset('storage/images/countries/flags/ki.svg')
			],[
				'code' => 'KP',
				'name' => "Korea North",
				'phonecode' => 850, 
				'flag' => asset('storage/images/countries/flags/kp.svg')
			],[
				'code' => 'KR',
				'name' => "Korea South",
				'phonecode' => 82, 
				'flag' => asset('storage/images/countries/flags/kr.svg')
			],[
				'code' => 'KW',
				'name' => "Kuwait",
				'phonecode' => 965, 
				'flag' => asset('storage/images/countries/flags/kw.svg')
			],[
				'code' => 'KG',
				'name' => "Kyrgyzstan",
				'phonecode' => 996, 
				'flag' => asset('storage/images/countries/flags/kg.svg')
			],[
				'code' => 'LA',
				'name' => "Laos",
				'phonecode' => 856, 
				'flag' => asset('storage/images/countries/flags/la.svg')
			],[
				'code' => 'LV',
				'name' => "Latvia",
				'phonecode' => 371, 
				'flag' => asset('storage/images/countries/flags/lv.svg')
			],[
				'code' => 'LB',
				'name' => "Lebanon",
				'phonecode' => 961, 
				'flag' => asset('storage/images/countries/flags/lb.svg')
			],[
				'code' => 'LS',
				'name' => "Lesotho",
				'phonecode' => 266, 
				'flag' => asset('storage/images/countries/flags/ls.svg')
			],[
				'code' => 'LR',
				'name' => "Liberia",
				'phonecode' => 231, 
				'flag' => asset('storage/images/countries/flags/lr.svg')
			],[
				'code' => 'LY',
				'name' => "Libya",
				'phonecode' => 218, 
				'flag' => asset('storage/images/countries/flags/ly.svg')
			],[
				'code' => 'LI',
				'name' => "Liechtenstein",
				'phonecode' => 423, 
				'flag' => asset('storage/images/countries/flags/li.svg')
			],[
				'code' => 'LT',
				'name' => "Lithuania",
				'phonecode' => 370, 
				'flag' => asset('storage/images/countries/flags/lt.svg')
			],[
				'code' => 'LU',
				'name' => "Luxembourg",
				'phonecode' => 352, 
				'flag' => asset('storage/images/countries/flags/lu.svg')
			],[
				'code' => 'MO',
				'name' => "Macau S.A.R.",
				'phonecode' => 853, 
				'flag' => asset('storage/images/countries/flags/mo.svg')
			],[
				'code' => 'MK',
				'name' => "Macedonia",
				'phonecode' => 389, 
				'flag' => asset('storage/images/countries/flags/mk.svg')
			],[
				'code' => 'MG',
				'name' => "Madagascar",
				'phonecode' => 261, 
				'flag' => asset('storage/images/countries/flags/mg.svg')
			],[
				'code' => 'MW',
				'name' => "Malawi",
				'phonecode' => 265, 
				'flag' => asset('storage/images/countries/flags/mw.svg')
			],[
				'code' => 'MY',
				'name' => "Malaysia",
				'phonecode' => 60, 
				'flag' => asset('storage/images/countries/flags/my.svg')
			],[
				'code' => 'MV',
				'name' => "Maldives",
				'phonecode' => 960, 
				'flag' => asset('storage/images/countries/flags/mv.svg')
			],[
				'code' => 'ML',
				'name' => "Mali",
				'phonecode' => 223, 
				'flag' => asset('storage/images/countries/flags/ml.svg')
			],[
				'code' => 'MT',
				'name' => "Malta",
				'phonecode' => 356, 
				'flag' => asset('storage/images/countries/flags/mt.svg')
			],[
				'code' => 'XM',
				'name' => "Man (Isle of]",
				'phonecode' => 44, 
				'flag' => asset('storage/images/countries/flags/xm.svg')
			],[
				'code' => 'MH',
				'name' => "Marshall Islands",
				'phonecode' => 692, 
				'flag' => asset('storage/images/countries/flags/mh.svg')
			],[
				'code' => 'MQ',
				'name' => "Martinique",
				'phonecode' => 596, 
				'flag' => asset('storage/images/countries/flags/mq.svg')
			],[
				'code' => 'MR',
				'name' => "Mauritania",
				'phonecode' => 222, 
				'flag' => asset('storage/images/countries/flags/mr.svg')
			],[
				'code' => 'MU',
				'name' => "Mauritius",
				'phonecode' => 230, 
				'flag' => asset('storage/images/countries/flags/mu.svg')
			],[
				'code' => 'YT',
				'name' => "Mayotte",
				'phonecode' => 269, 
				'flag' => asset('storage/images/countries/flags/yt.svg')
			],[
				'code' => 'MX',
				'name' => "Mexico",
				'phonecode' => 52, 
				'flag' => asset('storage/images/countries/flags/mx.svg')
			],[
				'code' => 'FM',
				'name' => "Micronesia",
				'phonecode' => 691, 
				'flag' => asset('storage/images/countries/flags/fm.svg')
			],[
				'code' => 'MD',
				'name' => "Moldova",
				'phonecode' => 373, 
				'flag' => asset('storage/images/countries/flags/md.svg')
			],[
				'code' => 'MC',
				'name' => "Monaco",
				'phonecode' => 377, 
				'flag' => asset('storage/images/countries/flags/mc.svg')
			],[
				'code' => 'MN',
				'name' => "Mongolia",
				'phonecode' => 976, 
				'flag' => asset('storage/images/countries/flags/mn.svg')
			],[
				'code' => 'MS',
				'name' => "Montserrat",
				'phonecode' => 1664, 
				'flag' => asset('storage/images/countries/flags/ms.svg')
			],[
				'code' => 'MA',
				'name' => "Morocco",
				'phonecode' => 212, 
				'flag' => asset('storage/images/countries/flags/ma.svg')
			],[
				'code' => 'MZ',
				'name' => "Mozambique",
				'phonecode' => 258, 
				'flag' => asset('storage/images/countries/flags/mz.svg')
			],[
				'code' => 'MM',
				'name' => "Myanmar",
				'phonecode' => 95, 
				'flag' => asset('storage/images/countries/flags/mm.svg')
			],[
				'code' => 'NA',
				'name' => "Namibia",
				'phonecode' => 264, 
				'flag' => asset('storage/images/countries/flags/na.svg')
			],[
				'code' => 'NR',
				'name' => "Nauru",
				'phonecode' => 674, 
				'flag' => asset('storage/images/countries/flags/nr.svg')
			],[
				'code' => 'NP',
				'name' => "Nepal",
				'phonecode' => 977, 
				'flag' => asset('storage/images/countries/flags/np.svg')
			],[
				'code' => 'AN',
				'name' => "Netherlands Antilles",
				'phonecode' => 599, 
				'flag' => asset('storage/images/countries/flags/an.svg')
			],[
				'code' => 'NL',
				'name' => "Netherlands",
				'phonecode' => 31, 
				'flag' => asset('storage/images/countries/flags/nl.svg')
			],[
				'code' => 'NC',
				'name' => "New Caledonia",
				'phonecode' => 687, 
				'flag' => asset('storage/images/countries/flags/nc.svg')
			],[
				'code' => 'NZ',
				'name' => "New Zealand",
				'phonecode' => 64, 
				'flag' => asset('storage/images/countries/flags/nz.svg')
			],[
				'code' => 'NI',
				'name' => "Nicaragua",
				'phonecode' => 505, 
				'flag' => asset('storage/images/countries/flags/ni.svg')
			],[
				'code' => 'NE',
				'name' => "Niger",
				'phonecode' => 227, 
				'flag' => asset('storage/images/countries/flags/ne.svg')
			],[
				'code' => 'NG',
				'name' => "Nigeria",
				'phonecode' => 234, 
				'flag' => asset('storage/images/countries/flags/ng.svg')
			],[
				'code' => 'NU',
				'name' => "Niue",
				'phonecode' => 683, 
				'flag' => asset('storage/images/countries/flags/nu.svg')
			],[
				'code' => 'NF',
				'name' => "Norfolk Island",
				'phonecode' => 672, 
				'flag' => asset('storage/images/countries/flags/nf.svg')
			],[
				'code' => 'MP',
				'name' => "Northern Mariana Islands",
				'phonecode' => 1670, 
				'flag' => asset('storage/images/countries/flags/mp.svg')
			],[
				'code' => 'NO',
				'name' => "Norway",
				'phonecode' => 47, 
				'flag' => asset('storage/images/countries/flags/no.svg')
			],[
				'code' => 'OM',
				'name' => "Oman",
				'phonecode' => 968, 
				'flag' => asset('storage/images/countries/flags/om.svg')
			],[
				'code' => 'PK',
				'name' => "Pakistan",
				'phonecode' => 92, 
				'flag' => asset('storage/images/countries/flags/pk.svg')
			],[
				'code' => 'PW',
				'name' => "Palau",
				'phonecode' => 680, 
				'flag' => asset('storage/images/countries/flags/pw.svg')
			],[
				'code' => 'PS',
				'name' => "Palestinian Territory Occupied",
				'phonecode' => 970, 
				'flag' => asset('storage/images/countries/flags/ps.svg')
			],[
				'code' => 'PA',
				'name' => "Panama",
				'phonecode' => 507, 
				'flag' => asset('storage/images/countries/flags/pa.svg')
			],[
				'code' => 'PG',
				'name' => "Papua new Guinea",
				'phonecode' => 675, 
				'flag' => asset('storage/images/countries/flags/pg.svg')
			],[
				'code' => 'PY',
				'name' => "Paraguay",
				'phonecode' => 595, 
				'flag' => asset('storage/images/countries/flags/py.svg')
			],[
				'code' => 'PE',
				'name' => "Peru",
				'phonecode' => 51, 
				'flag' => asset('storage/images/countries/flags/pe.svg')
			],[
				'code' => 'PH',
				'name' => "Philippines",
				'phonecode' => 63, 
				'flag' => asset('storage/images/countries/flags/ph.svg')
			],[
				'code' => 'PN',
				'name' => "Pitcairn Island",
				'phonecode' => 0, 
				'flag' => asset('storage/images/countries/flags/pn.svg')
			],[
				'code' => 'PL',
				'name' => "Poland",
				'phonecode' => 48, 
				'flag' => asset('storage/images/countries/flags/pl.svg')
			],[
				'code' => 'PT',
				'name' => "Portugal",
				'phonecode' => 351, 
				'flag' => asset('storage/images/countries/flags/pt.svg')
			],[
				'code' => 'PR',
				'name' => "Puerto Rico",
				'phonecode' => 1787, 
				'flag' => asset('storage/images/countries/flags/pr.svg')
			],[
				'code' => 'QA',
				'name' => "Qatar",
				'phonecode' => 974, 
				'flag' => asset('storage/images/countries/flags/qa.svg')
			],[
				'code' => 'RE',
				'name' => "Reunion",
				'phonecode' => 262, 
				'flag' => asset('storage/images/countries/flags/re.svg')
			],[
				'code' => 'RO',
				'name' => "Romania",
				'phonecode' => 40, 
				'flag' => asset('storage/images/countries/flags/ro.svg')
			],[
				'code' => 'RU',
				'name' => "Russia",
				'phonecode' => 70, 
				'flag' => asset('storage/images/countries/flags/ru.svg')
			],[
				'code' => 'RW',
				'name' => "Rwanda",
				'phonecode' => 250, 
				'flag' => asset('storage/images/countries/flags/rw.svg')
			],[
				'code' => 'SH',
				'name' => "Saint Helena",
				'phonecode' => 290, 
				'flag' => asset('storage/images/countries/flags/sh.svg')
			],[
				'code' => 'KN',
				'name' => "Saint Kitts And Nevis",
				'phonecode' => 1869, 
				'flag' => asset('storage/images/countries/flags/kn.svg')
			],[
				'code' => 'LC',
				'name' => "Saint Lucia",
				'phonecode' => 1758, 
				'flag' => asset('storage/images/countries/flags/lc.svg')
			],[
				'code' => 'PM',
				'name' => "Saint Pierre and Miquelon",
				'phonecode' => 508, 
				'flag' => asset('storage/images/countries/flags/pm.svg')
			],[
				'code' => 'VC',
				'name' => "Saint Vincent And The Grenadines",
				'phonecode' => 1784, 
				'flag' => asset('storage/images/countries/flags/vc.svg')
			],[
				'code' => 'WS',
				'name' => "Samoa",
				'phonecode' => 684, 
				'flag' => asset('storage/images/countries/flags/ws.svg')
			],[
				'code' => 'SM',
				'name' => "San Marino",
				'phonecode' => 378, 
				'flag' => asset('storage/images/countries/flags/sm.svg')
			],[
				'code' => 'ST',
				'name' => "Sao Tome and Principe",
				'phonecode' => 239, 
				'flag' => asset('storage/images/countries/flags/st.svg')
			],[
				'code' => 'SA',
				'name' => "Saudi Arabia",
				'phonecode' => 966, 
				'flag' => asset('storage/images/countries/flags/sa.svg')
			],[
				'code' => 'SN',
				'name' => "Senegal",
				'phonecode' => 221, 
				'flag' => asset('storage/images/countries/flags/sn.svg')
			],[
				'code' => 'RS',
				'name' => "Serbia",
				'phonecode' => 381, 
				'flag' => asset('storage/images/countries/flags/rs.svg')
			],[
				'code' => 'SC',
				'name' => "Seychelles",
				'phonecode' => 248, 
				'flag' => asset('storage/images/countries/flags/sc.svg')
			],[
				'code' => 'SL',
				'name' => "Sierra Leone",
				'phonecode' => 232, 
				'flag' => asset('storage/images/countries/flags/sl.svg')
			],[
				'code' => 'SG',
				'name' => "Singapore",
				'phonecode' => 65, 
				'flag' => asset('storage/images/countries/flags/sg.svg')
			],[
				'code' => 'SK',
				'name' => "Slovakia",
				'phonecode' => 421, 
				'flag' => asset('storage/images/countries/flags/sk.svg')
			],[
				'code' => 'SI',
				'name' => "Slovenia",
				'phonecode' => 386, 
				'flag' => asset('storage/images/countries/flags/si.svg')
			],[
				'code' => 'XG',
				'name' => "Smaller Territories of the UK",
				'phonecode' => 44, 
				'flag' => asset('storage/images/countries/flags/xg.svg')
			],[
				'code' => 'SB',
				'name' => "Solomon Islands",
				'phonecode' => 677, 
				'flag' => asset('storage/images/countries/flags/sb.svg')
			],[
				'code' => 'SO',
				'name' => "Somalia",
				'phonecode' => 252, 
				'flag' => asset('storage/images/countries/flags/so.svg')
			],[
				'code' => 'ZA',
				'name' => "South Africa",
				'phonecode' => 27, 
				'flag' => asset('storage/images/countries/flags/za.svg')
			],[
				'code' => 'GS',
				'name' => "South Georgia",
				'phonecode' => 0, 
				'flag' => asset('storage/images/countries/flags/gs.svg')
			],[
				'code' => 'SS',
				'name' => "South Sudan",
				'phonecode' => 211, 
				'flag' => asset('storage/images/countries/flags/ss.svg')
			],[
				'code' => 'ES',
				'name' => "Spain",
				'phonecode' => 34, 
				'flag' => asset('storage/images/countries/flags/es.svg')
			],[
				'code' => 'LK',
				'name' => "Sri Lanka",
				'phonecode' => 94, 
				'flag' => asset('storage/images/countries/flags/lk.svg')
			],[
				'code' => 'SD',
				'name' => "Sudan",
				'phonecode' => 249, 
				'flag' => asset('storage/images/countries/flags/sd.svg')
			],[
				'code' => 'SR',
				'name' => "Suriname",
				'phonecode' => 597, 
				'flag' => asset('storage/images/countries/flags/sr.svg')
			],[
				'code' => 'SJ',
				'name' => "Svalbard And Jan Mayen Islands",
				'phonecode' => 47, 
				'flag' => asset('storage/images/countries/flags/sj.svg')
			],[
				'code' => 'SZ',
				'name' => "Swaziland",
				'phonecode' => 268, 
				'flag' => asset('storage/images/countries/flags/sz.svg')
			],[
				'code' => 'SE',
				'name' => "Sweden",
				'phonecode' => 46, 
				'flag' => asset('storage/images/countries/flags/se.svg')
			],[
				'code' => 'CH',
				'name' => "Switzerland",
				'phonecode' => 41, 
				'flag' => asset('storage/images/countries/flags/ch.svg')
			],[
				'code' => 'SY',
				'name' => "Syria",
				'phonecode' => 963, 
				'flag' => asset('storage/images/countries/flags/sy.svg')
			],[
				'code' => 'TW',
				'name' => "Taiwan",
				'phonecode' => 886, 
				'flag' => asset('storage/images/countries/flags/tw.svg')
			],[
				'code' => 'TJ',
				'name' => "Tajikistan",
				'phonecode' => 992, 
				'flag' => asset('storage/images/countries/flags/tj.svg')
			],[
				'code' => 'TZ',
				'name' => "Tanzania",
				'phonecode' => 255, 
				'flag' => asset('storage/images/countries/flags/tz.svg')
			],[
				'code' => 'TH',
				'name' => "Thailand",
				'phonecode' => 66, 
				'flag' => asset('storage/images/countries/flags/th.svg')
			],[
				'code' => 'TG',
				'name' => "Togo",
				'phonecode' => 228, 
				'flag' => asset('storage/images/countries/flags/tg.svg')
			],[
				'code' => 'TK',
				'name' => "Tokelau",
				'phonecode' => 690, 
				'flag' => asset('storage/images/countries/flags/tk.svg')
			],[
				'code' => 'TO',
				'name' => "Tonga",
				'phonecode' => 676, 
				'flag' => asset('storage/images/countries/flags/to.svg')
			],[
				'code' => 'TT',
				'name' => "Trinidad And Tobago",
				'phonecode' => 1868, 
				'flag' => asset('storage/images/countries/flags/tt.svg')
			],[
				'code' => 'TN',
				'name' => "Tunisia",
				'phonecode' => 216, 
				'flag' => asset('storage/images/countries/flags/tn.svg')
			],[
				'code' => 'TR',
				'name' => "Turkey",
				'phonecode' => 90, 
				'flag' => asset('storage/images/countries/flags/tr.svg')
			],[
				'code' => 'TM',
				'name' => "Turkmenistan",
				'phonecode' => 7370, 
				'flag' => asset('storage/images/countries/flags/tm.svg')
			],[
				'code' => 'TC',
				'name' => "Turks And Caicos Islands",
				'phonecode' => 1649, 
				'flag' => asset('storage/images/countries/flags/tc.svg')
			],[
				'code' => 'TV',
				'name' => "Tuvalu",
				'phonecode' => 688, 
				'flag' => asset('storage/images/countries/flags/tv.svg')
			],[
				'code' => 'UG',
				'name' => "Uganda",
				'phonecode' => 256, 
				'flag' => asset('storage/images/countries/flags/ug.svg')
			],[
				'code' => 'UA',
				'name' => "Ukraine",
				'phonecode' => 380, 
				'flag' => asset('storage/images/countries/flags/ua.svg')
			],[
				'code' => 'AE',
				'name' => "United Arab Emirates",
				'phonecode' => 971, 
				'flag' => asset('storage/images/countries/flags/ae.svg')
			],[
				'code' => 'GB'
				,'name' => "United Kingdom",
				'phonecode' => 44, 
				'flag' => asset('storage/images/countries/flags/gb.svg')
			],[
				'code' => 'US',
				'name' => "United States",
				'phonecode' => 1, 
				'flag' => asset('storage/images/countries/flags/us.svg')
			],[
				'code' => 'UM',
				'name' => "United States Minor Outlying Islands",
				'phonecode' => 1, 
				'flag' => asset('storage/images/countries/flags/um.svg')
			],[
				'code' => 'UY',
				'name' => "Uruguay",
				'phonecode' => 598, 
				'flag' => asset('storage/images/countries/flags/uy.svg')
			],[
				'code' => 'UZ',
				'name' => "Uzbekistan",
				'phonecode' => 998, 
				'flag' => asset('storage/images/countries/flags/uz.svg')
			],[
				'code' => 'VU',
				'name' => "Vanuatu",
				'phonecode' => 678, 
				'flag' => asset('storage/images/countries/flags/vu.svg')
			],[
				'code' => 'VA',
				'name' => "Vatican City State (Holy See]",
				'phonecode' => 39, 
				'flag' => asset('storage/images/countries/flags/va.svg')
			],[
				'code' => 'VE',
				'name' => "Venezuela",
				'phonecode' => 58, 
				'flag' => asset('storage/images/countries/flags/ve.svg')
			],[
				'code' => 'VN',
				'name' => "Vietnam",
				'phonecode' => 84, 
				'flag' => asset('storage/images/countries/flags/vn.svg')
			],[
				'code' => 'VG',
				'name' => "Virgin Islands (British]",
				'phonecode' => 1284, 
				'flag' => asset('storage/images/countries/flags/vg.svg')
			],[
				'code' => 'VI',
				'name' => "Virgin Islands (US]",
				'phonecode' => 1340, 
				'flag' => asset('storage/images/countries/flags/vi.svg')
			],[
				'code' => 'WF',
				'name' => "Wallis And Futuna Islands",
				'phonecode' => 681, 
				'flag' => asset('storage/images/countries/flags/wf.svg')
			],[
				'code' => 'EH',
				'name' => "Western Sahara",
				'phonecode' => 212, 
				'flag' => asset('storage/images/countries/flags/eh.svg')
			],[
				'code' => 'YE',
				'name' => "Yemen",
				'phonecode' => 967, 
				'flag' => asset('storage/images/countries/flags/ye.svg')
			],[
				'code' => 'YU',
				'name' => "Yugoslavia",
				'phonecode' => 38, 
                'flag' => asset('storage/images/countries/flags/yu.svg')
			],[
				'code' => 'ZM',
				'name' => "Zambia",
				'phonecode' => 260, 
				'flag' => asset('storage/images/countries/flags/zm.svg')
			],[
				'code' => 'ZW',
				'name' => "Zimbabwe",
				'phonecode' => 263, 
				'flag' => asset('storage/images/countries/flags/zw.svg')
			]
		]);

    }
}
