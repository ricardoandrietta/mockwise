# Mock Wise

Mock Wise is a powerful fake data generation API designed for software developers. It allows you to generate realistic mock data based on your schema definitions, making it perfect for development, testing, and demonstration purposes.

## Overview

Mock Wise provides a RESTful API that generates fake data based on your JSON schema definitions. With support for a wide range of data types and customizable options, it helps developers create realistic test data quickly and efficiently.

## Authentication

Mock Wise uses Bearer Token authentication. To use the API:

1. Register for an account at [Mock Wise website]
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
  "schema": {
    "name": {
      "type": "person.fullName"
    },
    "email": {
      "type": "internet.email"
    },
    "address": {
      "type": "address.fullAddress"
    }
  }
}
```

### Response Example
```json
{
  "data": {
    "name": "John Smith",
    "email": "john.smith@example.com",
    "address": "123 Main St, New York, NY 10001"
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
- 429: Too Many Requests (rate limit exceeded)
- 500: Internal Server Error

Error responses include detailed messages to help identify and resolve issues:

```json
{
  "error": {
    "code": "INVALID_SCHEMA",
    "message": "Invalid schema format provided",
    "details": {
      "field": "email",
      "issue": "Unknown type specified"
    }
  }
}
```

## Support

For additional support or questions:
- Documentation: [Documentation URL]
- Email: support@mockwise.dev
- API Status: [Status URL]

## Legal

- Terms of Service: [Terms URL]
- Privacy Policy: [Privacy URL]
- License: Proprietary software. All rights reserved.
