# 🌐 HTTP Status Codes Complete Reference

[![HTTP Specs](https://img.shields.io/badge/HTTP%20Status%20Codes-Reference-007ACC?style=for-the-badge&logo=http)](https://github.com/MattIPv4/status-codes)
[![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg?style=for-the-badge)](https://www.gnu.org/licenses/gpl-3.0)
[![Frameworks](https://img.shields.io/badge/Supports-Laravel%20%7C%20Spring%20%7C%20Cloudflare%20%7C%20nginx-orange?style=for-the-badge)]()

---

## 🚀 Quick Navigation Dashboard

| Class | Type | Range | Quick Link |
| :---: | :--- | :---: | :--- |
| ℹ️ | **Informational** | `100 - 103` | [Jump to 1xx](#-1xx---informational-codes) |
| ✅ | **Successful** | `200 - 226` | [Jump to 2xx](#-2xx---successful-codes) |
| 🔀 | **Redirection** | `300 - 308` | [Jump to 3xx](#-3xx---redirection-codes) |
| ⚠️ | **Client Error** | `400 - 499` | [Jump to 4xx](#%EF%B8%8F-4xx---client-error-codes) |
| ❌ | **Server Error** | `500 - 598` | [Jump to 5xx](#-5xx---server-error-codes) |

---

## ℹ️ 1xx - Informational Codes

> [!NOTE]
> **1xx Informational**: Indicates a provisional response consisting of connection status information. Not intended for final request or response actions.

| Code | Status Message | Scope / Origin | Description |
| :---: | :--- | :---: | :--- |
| `100` | **Continue** | Standard HTTP | Client should continue sending request body. |
| `101` | **Switching Protocols** | Standard HTTP | Server agrees to switch protocols (e.g., HTTP to WebSockets). |
| `102` | **Processing** | WebDAV | Request received and being processed; no response available yet. |
| `103` | **Early Hints** | Standard HTTP | Returns response headers before final HTTP payload is ready. |

---

## ✅ 2xx - Successful Codes

> [!TIP]
> **2xx Success**: Indicates that the client's request was successfully received, understood, and accepted by the server.

| Code | Status Message | Scope / Origin | Description |
| :---: | :--- | :---: | :--- |
| `200` | **OK** | Standard HTTP | Standard response for successful HTTP requests. |
| `201` | **Created** | Standard HTTP | Request fulfilled, resulting in the creation of a new resource. |
| `202` | **Accepted** | Standard HTTP | Request accepted for processing, but processing is not yet completed. |
| `203` | **Non-Authoritative Info** | Standard HTTP | Payload modified by a transforming proxy. |
| `204` | **No Content** | Standard HTTP | Request processed successfully; no content returned in response body. |
| `205` | **Reset Content** | Standard HTTP | Server requests sender to reset document view. |
| `206` | **Partial Content** | Standard HTTP | Delivering portion of resource due to range header sent by client. |
| `207` | **Multi-Status** | WebDAV | Conveys information about multiple resources (XML response body). |
| `208` | **Already Reported** | WebDAV | Avoids repeatedly enumerating DAV binding elements. |
| `218` | **This is fine** | Apache Server | Catch-all error pass-through for Apache web server. |
| `226` | **IM Used** | HTTP Delta | Request fulfilled using instance-manipulations. |

---

## 🔀 3xx - Redirection Codes

> [!IMPORTANT]
> **3xx Redirection**: Indicates the user agent must take additional action to complete the request (e.g., following a URL redirect).

| Code | Status Message | Scope / Origin | Description |
| :---: | :--- | :---: | :--- |
| `300` | **Multiple Choices** | Standard HTTP | Indicates multiple options available for the requested resource. |
| `301` | **Moved Permanently** | Standard HTTP | Resource permanently moved to a new URI. |
| `302` | **Found** | Standard HTTP | Resource temporarily resides under a different URI. |
| `303` | **See Other** | Standard HTTP | Response accessible under another URI using `GET`. |
| `304` | **Not Modified** | Standard HTTP | Resource not modified since last requested (caching active). |
| `306` | **Switch Proxy** | Standard HTTP | *(Deprecated)* Previously instructed client to use a designated proxy. |
| `307` | **Temporary Redirect** | Standard HTTP | Re-issue request to temporary URI using identical HTTP method. |
| `308` | **Permanent Redirect** | Standard HTTP | Re-issue request to permanent URI using identical HTTP method. |

---

## ⚠️ 4xx - Client Error Codes

> [!WARNING]
> **4xx Client Error**: Error responses specifying an issue on the client's side (e.g., malformed syntax, missing authorization, or CSRF expiration).

| Code | Status Message | Scope / Origin | Description |
| :---: | :--- | :---: | :--- |
| `400` | **Bad Request** | Standard HTTP | Cannot process request due to client error (malformed syntax). |
| `401` | **Unauthorized** | Standard HTTP | Authentication required; credentials invalid or missing. |
| `402` | **Payment Required** | Standard HTTP | Reserved for future digital payment systems. |
| `403` | **Forbidden** | Standard HTTP | Client authenticated but lacks permissions for resource. |
| `404` | **Not Found** | Standard HTTP | Requested resource could not be found on server. |
| `405` | **Method Not Allowed** | Standard HTTP | HTTP method not supported for target resource. |
| `406` | **Not Acceptable** | Standard HTTP | Cannot generate response matching `Accept` headers. |
| `407` | **Proxy Auth Required** | Standard HTTP | Client must first authenticate with the proxy server. |
| `408` | **Request Timeout** | Standard HTTP | Server timed out waiting for client request. |
| `409` | **Conflict** | Standard HTTP | Request conflicts with current state of server. |
| `410` | **Gone** | Standard HTTP | Resource permanently deleted without forwarding address. |
| `411` | **Length Required** | Standard HTTP | Missing required `Content-Length` request header. |
| `412` | **Precondition Failed** | Standard HTTP | Preconditions in request headers evaluated to false. |
| `413` | **Payload Too Large** | Standard HTTP | Request payload exceeds size limits enforced by server. |
| `414` | **URI Too Long** | Standard HTTP | URI requested is longer than server is willing to interpret. |
| `415` | **Unsupported Media Type** | Standard HTTP | Media payload format not supported by endpoint. |
| `416` | **Range Not Satisfiable** | Standard HTTP | Client requested range cannot be fulfilled. |
| `417` | **Expectation Failed** | Standard HTTP | Expectation given in `Expect` request header cannot be met. |
| `418` | **I'm a teapot** | HTCPCP (RFC 2324) | April Fools hyper text coffee pot control protocol. |
| `419` | **Page Expired** | 🔴 **Laravel Framework** | **CSRF Token Mismatch / Session Expiration** in Laravel web forms. |
| `420` | **Method Failure** | Spring Framework | *(Deprecated)* Spring framework status code. |
| `421` | **Misdirected Request** | Standard HTTP | Directed to a server unable to produce a response. |
| `422` | **Unprocessable Entity** | WebDAV / REST | **Validation Error**: Well-formed request containing semantic errors. |
| `423` | **Locked** | WebDAV | Target resource is locked. |
| `424` | **Failed Dependency** | WebDAV | Request failed due to failure of a dependent request. |
| `426` | **Upgrade Required** | Standard HTTP | Client should switch protocols (e.g., to TLS/1.3). |
| `428` | **Precondition Required** | Standard HTTP | Origin server requires request to be conditional. |
| `429` | **Too Many Requests** | Standard HTTP | **Rate Limiting**: Rate limit exceeded for given timeframe. |
| `431` | **Header Fields Too Large** | Standard HTTP | Individual or aggregate header fields exceed limits. |
| `440` | **Login Time-out** | Microsoft IIS | Client session expired; user must re-authenticate. |
| `444` | **No Response** | nginx | Nginx closes connection without sending data to client. |
| `449` | **Retry With** | Microsoft IIS | Retry request after performing appropriate action. |
| `450` | **Blocked by Windows** | Microsoft | Access blocked by Windows Parental Controls. |
| `451` | **Unavailable Legal Reasons** | Standard HTTP | Access denied due to legal demands or censorship. |
| `494` | **Request Header Too Large** | nginx | Header length exceeds nginx buffer size limit. |
| `495` | **SSL Certificate Error** | nginx | Client SSL certificate validation failed. |
| `496` | **SSL Certificate Required** | nginx | Client failed to provide required SSL certificate. |
| `497` | **HTTP Sent to HTTPS Port** | nginx | Plain HTTP request sent to HTTPS encrypted port. |
| `498` | **Invalid Token** | Esri | ArcGIS token invalid or expired. |
| `499` | **Client Closed Request** | nginx | Client closed connection while nginx was processing. |

---

## ❌ 5xx - Server Error Codes

> [!CAUTION]
> **5xx Server Error**: Indicates that the server failed to fulfill a valid request due to an unhandled exception, proxy failure, or server overload.

| Code | Status Message | Scope / Origin | Description |
| :---: | :--- | :---: | :--- |
| `500` | **Internal Server Error** | Standard HTTP | Unexpected server condition / uncaught runtime exception. |
| `501` | **Not Implemented** | Standard HTTP | Server does not support functionality required for request. |
| `502` | **Bad Gateway** | Standard HTTP | Gateway/proxy received invalid response from upstream server. |
| `503` | **Service Unavailable** | Standard HTTP | Server temporarily unable to handle request (maintenance/overload). |
| `504` | **Gateway Timeout** | Standard HTTP | Gateway/proxy timed out waiting for upstream server. |
| `505` | **HTTP Version Not Supported** | Standard HTTP | HTTP protocol version used in request is not supported. |
| `506` | **Variant Also Negotiates** | Standard HTTP | Circular reference in transparent content negotiation. |
| `507` | **Insufficient Storage** | WebDAV | Server lacks storage capacity to complete request representation. |
| `508` | **Loop Detected** | WebDAV | Infinite loop detected while processing WebDAV request. |
| `509` | **Bandwidth Limit Exceeded** | Apache / cPanel | Server bandwidth quota exceeded. |
| `510` | **Not Extended** | Standard HTTP | Request requires further protocol extensions to be fulfilled. |
| `511` | **Network Auth Required** | Standard HTTP | Client must authenticate to gain network access (captive portal). |
| `520` | **Unknown Error** | Cloudflare | Catch-all when origin server returns an unexpected response. |
| `521` | **Web Server Is Down** | Cloudflare | Origin web server refuses connections from Cloudflare. |
| `522` | **Connection Timed Out** | Cloudflare | Cloudflare could not complete TCP handshake with origin. |
| `523` | **Origin Is Unreachable** | Cloudflare | Cloudflare cannot resolve or reach origin server. |
| `524` | **A Timeout Occurred** | Cloudflare | Cloudflare connected, but origin didn't reply in time. |
| `525` | **SSL Handshake Failed** | Cloudflare | SSL/TLS handshake between Cloudflare and origin failed. |
| `526` | **Invalid SSL Certificate** | Cloudflare | Cloudflare cannot validate origin SSL certificate. |
| `527` | **Railgun Listener Error** | Cloudflare | Connection error between Railgun listener and origin. |
| `530` | **Origin DNS Error** | Cloudflare | Cloudflare could not resolve DNS record for target domain. |
| `598` | **Network Read Timeout** | Informal Convention | Proxy network read timeout error. |

---

## 🎯 Laravel HTTP Response Cheat Sheet

| Status Code | Laravel Context | Example Usage |
| :---: | :--- | :--- |
| `200 OK` | Fetch list / detail | `response()->json($courses, 200)` |
| `201 Created` | Store new record | `response()->json($course, 201)` |
| `204 No Content` | Delete record | `response()->noContent()` |
| `401 Unauthorized` | Auth failed (Sanctum) | `abort(401, 'Unauthenticated')` |
| `403 Forbidden` | Policy / Gate failed | `$this->authorize('update', $course)` |
| `404 Not Found` | Model not found | `Course::findOrFail($id)` |
| `419 Page Expired` | CSRF token missing | Web form without `@csrf` |
| `422 Unprocessable` | Form Validation failed | `$request->validate([...])` |
| `429 Too Many Requests` | Rate limit exceeded | `Route::middleware('throttle:60,1')` |
| `500 Server Error` | Uncaught Exception | Unhandled PHP runtime exception |

---

## 🛠 Project Info & Licensing

- **Original Author:** Matt Cowley ([IPv4](https://github.com/MattIPv4))
- **Source Repository:** [MattIPv4/status-codes](https://github.com/MattIPv4/status-codes)
- **License:** [GNU General Public License v3.0](https://www.gnu.org/licenses/gpl-3.0.html)