<?php
namespace nicDamours\Validator;

class Regex {
    const PASSWORD = "/^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{7,20})\S$/";
    const NAME = "/^[a-z ,.'\-éèêëáàâäíìîïóòôöúùûü]+$/ui";
    const NIP = "/^[0-9]+$/";
    const CANADA_POSTAL_CODE = "/^([ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ])\ {0,1}(\d[ABCEGHJKLMNPRSTVWXYZ]\d)$/";
    const USA_POSTAL_CODE = "/^\d{5}([\-]?\d{4})?$/";
    const ADDRESS = "/\b(\d{2,5}\s+)(?![a|p]m\b)(NW|NE|SW|SE|north|south|west|east|n|e|s|w)?([\s|\,|.]+)?(([a-zA-Z|\s+]{1,30}){1,4})(court|ct|street|st|drive|dr|lane|ln|road|rd|blvd)/i";
    const STATE = "/(?:Ala(?:bama|ska)|Alberta|Arizona|Arkansas|British Columbia|California|Colorado|Connecticut|Delaware|District of Columbia|Florida|Georgia|Hawaii|Idaho|Illinois|Indiana|Iowa|Kansas|Kentucky|Louisiana|Maine|Manitoba|Maryland|Massachusetts|Michigan|Minnesota|Miss(?:issippi|ouri)|Montana|Nebraska|Nevada|New(?: Brunswick| Hampshire| Jersey| Mexico| York|foundland)|North(?: Carolina| Dakota|west Territory)|Nova Scotia|Ohio|Oklahoma|Ontario|Oregon|Pennsylvania|Prince Edward Island|Quebec|Québec|Rhode Island|Saskatchewan|South (?:Carolina|Dakota)|Tennessee|Texas|Utah|Vermont|Virginia|Washington|West Virginia|Wisconsin|Wyoming|Yukon Territory|A[BKLRZ]|BC|C[AOT]|D[CE]|FL|GA|HI|I[ADLN]|K[SY]|LA|M[ABDEINOST]|N[B-FHJMSTVY]|O[HKNR]|P[AE]|QC|RI|S[CDK]|T[NX]|UT|V[AT]|W[AIVY]|YT)/";
    const PRODUCT_NAME = "/^[a-z 0-9 éèëáàäíìïóòöç,._'#-]+$/i";
    const LOWER_ALPHA_NUMERIC = "/^[a-z0-9]+$/i";
    const ALPHA_NUMERIC = "/^[a-zA-Z0-9]/";
    const UPPER_ALPHA_NUMERIC = "/^[A-Z0-9]+$/i";
    const VISA = "/^4[0-9]{12}(?:[0-9]{3})?$/";
    const MASTERCARD = "/^5[1-5][0-9]{14}$/";
    const EXP_DATE = "/\b(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})\b/";
    const CCV = "/^[0-9]{3,4}$/";
    const NUMERIC = "/^(-)?[0-9]+$/";
    const FLOAT = "/^(-)?[0-9]+(?:\.[0-9]+)?$/";
    const TOWN = "/^[a-zA-Zéèà]+(?:[\s-][a-zA-Z]+)*$/";
    const CONFIRM_CODE = "/^[a-z0-9]{50}$/";
    const PHONE = "/^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/";
    const URL = "/_^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\x{00a1}-\x{ffff}0-9]+-?)*[a-z\x{00a1}-\x{ffff}0-9]+)(?:\.(?:[a-z\x{00a1}-\x{ffff}0-9]+-?)*[a-z\x{00a1}-\x{ffff}0-9]+)*(?:\.(?:[a-z\x{00a1}-\x{ffff}]{2,})))(?::\d{2,5})?(?:/[^\s]*)?\$_iuS/";
    const DATE = "/^[0-9]{4}(-|\/)(0[1-9]|1[0-2])(-|\/)(0[1-9]|[1-2][0-9]|3[0-1])$/";
    const FRENCH_WEEK_DAY = "/(?:DIM|LUN|MAR|MER|JEU|VEN|SAM)/";
    const ISO_DATE = "/(\d{4})-(\d{2})-(\d{2})T(\d{2})\:(\d{2})\:(\d{2})([+-](\d{2})(\:)?(\d{2}))?/";
    const TOKEN = "/([a-z0-9:\-_]*){0,200}/";
    const TITLE = "/^[a-z0-9 éèêëáàâäíìîïóòôöúùûü \/'\ :\-\(\.\)\,\|\!\?\[\]\#]+$/i";
    const HEX_COLOR = "/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/";
    const STRIPE_TOKEN = "/^((tok_|sub_|cus_|card_)([a-zA-Z0-9])+)$/";
    const DATE_TIME = "/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/";
    const LATITUDE_LONGITUDE = "/^-?[0-9]{1,3}(?:\.[0-9]{1,20})?$/";
    const PATH = "/^(.+)\/([^\/]+)$/";
    const VERSION = "/^(\d+\.)?(\d+\.)?(\*|\d+)$/";
}
