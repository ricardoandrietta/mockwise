# Mock Wise

Mock Wise is a powerful fake data generation API designed for software developers. It allows you to generate realistic mock data based on your schema definitions, making it perfect for development, testing, and demonstration purposes.

## Overview

Mock Wise provides a RESTful API that generates fake data based on your JSON schema definitions. With support for a wide range of data types and customizable options, it helps developers create realistic test data quickly and efficiently.

## Authentication

Mock Wise uses Bearer Token authentication. To use the API:

1. Register for an account at [Mock Wise website](https://mockwise.dev)
2. Obtain your API token from the dashboard
3. Include the token in your API requests using the Bearer Token authentication header

Example:
```
Authorization: Bearer your_api_token_here
```

## Supported Data Types

Mock Wise supports a comprehensive range of data types for generating fake data:

### Basic Types
- Numbers and Strings
- Text and Paragraphs
- Date and Time
- UUID
- Color

### Internet & Technology
- Internet (emails, domains, URLs)
- HTML Lorem
- File
- Image
- Barcode

### Personal Information
- Person (names, gender, etc.)
- Address
- Phone Number
- Company

### Financial
- Payment (credit cards, bank accounts)

## Making API Requests

### Endpoint
```
POST /api/v1/generate
```

### Request Format
```json
{
    "locale": "pt_BR",
    "show_errors": true,
    "repeat": 1,
    "single_item": true,
    "mock": [
        {
            "field": "first_name",
            "type": "firstName"
        },
        {
            "field": "middle_name",
            "type": "middleName"
        },
        {
            "field": "last_name",
            "type": "lastName"
        },
        {
            "field": "contact",
            "type": "nested",
            "params": {
                "locale": "en_CA",
                "show_errors": false,
                "repeat": 3,
                "mock": {
                    "phone_number": {
                        "type": "phoneNumber"
                    }
                }
            }
        }
    ]
}
```

### Response Example
```json
{
    "first_name": "Guilherme",
    "last_name": "Matias",
    "contact": [
        {
            "phone_number": "1-137-254-3267"
        },
        {
            "phone_number": "1 (257) 692-6254"
        },
        {
            "phone_number": "+1 (553) 720-8126"
        }
    ],
    "errors": {
        "middle_name": "'middleName' is not a valid type"
    }
}
```

## Requirements

- API requests can be made using any HTTP client (e.g., Postman, cURL, etc.)
- Valid API token required for authentication

## Rate Limiting

Please refer to our documentation for current rate limiting policies and pricing tiers.

## Error Handling

The API uses standard HTTP response codes:
- 200: Success
- 400: Bad Request (invalid schema)
- 401: Unauthorized (invalid token)
- 422: Unprocessable Entity
- 429: Too Many Requests (rate limit exceeded)
- 500: Internal Server Error

## Available Locales

| Locale     | Description                   |
|------------|-------------------------------|
| ar_EG      | Arabic (Egypt)                |
| ar_JO      | Arabic (Jordan)               |
| ar_SA      | Arabic (Saudi Arabia)         |
| at_AT      | Austrian (Austria)            |
| bg_BG      | Bulgarian (Bulgaria)          |
| bn_BD      | Bangla (Bangladesh)           |
| cs_CZ      | Czech (Czech Republic)        |
| da_DK      | Danish (Denmark)              |
| de_AT      | German (Austria)              |
| de_CH      | German (Switzerland)          |
| de_DE      | German (Germany)              |
| el_CY      | Greek (Cyprus)                |
| el_GR      | Greek (Greece)                |
| en_AU      | English (Australia)           |
| en_CA      | English (Canada)              |
| en_GB      | English (United Kingdom)      |
| en_HK      | English (Hong Kong SAR China) |
| en_IN      | English (India)               |
| en_NG      | English (Nigeria)             |
| en_NZ      | English (New Zealand)         |
| en_PH      | English (Philippines)         |
| en_SG      | English (Singapore)           |
| en_UG      | English (Uganda)              |
| en_US      | English (United States)       |
| en_ZA      | English (South Africa)        |
| es_AR      | Spanish (Argentina)           |
| es_ES      | Spanish (Spain)               |
| es_PE      | Spanish (Peru)                |
| es_VE      | Spanish (Venezuela)           |
| et_EE      | Estonian (Estonia)            |
| fa_IR      | Persian (Iran)                |
| fi_FI      | Finnish (Finland)             |
| fr_BE      | French (Belgium)              |
| fr_CA      | French (Canada)               |
| fr_CH      | French (Switzerland)          |
| fr_FR      | French (France)               |
| he_IL      | Hebrew (Israel)               |
| hr_HR      | Croatian (Croatia)            |
| hu_HU      | Hungarian (Hungary)           |
| hy_AM      | Armenian (Armenia)            |
| id_ID      | Indonesian (Indonesia)        |
| is_IS      | Icelandic (Iceland)           |
| it_CH      | Italian (Switzerland)         |
| it_IT      | Italian (Italy)               |
| ja_JP      | Japanese (Japan)              |
| ka_GE      | Georgian (Georgia)            |
| kk_KZ      | Kazakh (Kazakhstan)           |
| ko_KR      | Korean (South Korea)          |
| lt_LT      | Lithuanian (Lithuania)        |
| lv_LV      | Latvian (Latvia)              |
| me_ME      | Montenegrin (Montenegro)      |
| mn_MN      | Mongolian (Mongolia)          |
| ms_MY      | Malay (Malaysia)              |
| nb_NO      | Norwegian (Norway)            |
| ne_NP      | Nepali (Nepal)                |
| nl_BE      | Dutch (Belgium)               |
| nl_NL      | Dutch (Netherlands)           |
| pl_PL      | Polish (Poland)               |
| pt_BR      | Portuguese (Brazil)           |
| pt_PT      | Portuguese (Portugal)         |
| ro_MD      | Romanian (Moldova)            |
| ro_RO      | Romanian (Romania)            |
| ru_RU      | Russian (Russia)              |
| sk_SK      | Slovak (Slovakia)             |
| sl_SI      | Slovenian (Slovenia)          |
| sr_Cyrl_RS | Serbian (Cyrillic, Serbia)    |
| sr_Latn_RS | Serbian (Latin, Serbia)       |
| sr_RS      | Serbian (Serbia)              |
| sv_SE      | Swedish (Sweden)              |
| th_TH      | Thai (Thailand)               |
| tr_TR      | Turkish (Turkey)              |
| uk_UA      | Ukrainian (Ukraine)           |
| vi_VN      | Vietnamese (Vietnam)          |
| zh_CN      | Chinese (Simplified, China)   |
| zh_TW      | Chinese (Traditional, Taiwan) |

## Support

For additional support or questions:
- [Documentation](https://docs.mockwise.dev/)
- Email: support@mockwise.dev

## Legal

- [Terms of Service](https://mockwise.dev/terms)
- [Privacy Policy](https://mockwise.dev/privacy)
- License: GPL-3.0
