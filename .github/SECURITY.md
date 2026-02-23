# Security Policy

## Supported Versions

Security updates are provided for the following versions:

| Version | Supported          |
|---------|--------------------|
| Latest  | :white_check_mark: |

## Reporting a Vulnerability

If you discover a security vulnerability in the Velyx Registry, please follow these steps:

### Do NOT create a public issue

Security vulnerabilities should **not** be reported via public GitHub issues. Instead, please follow the process below.

### How to Report

1. **Email us at** [security@velyx.dev](mailto:security@velyx.dev)
2. Include as much detail as possible:
   - Description of the vulnerability
   - Steps to reproduce the issue
   - Potential impact
   - Suggested fix (if known)
   - Proof of concept (if available, encrypted)

### What to Expect

- **Confirmation**: We will acknowledge receipt of your report within 48 hours
- **Investigation**: We will investigate the vulnerability and determine its severity using CVSS scoring
- **Resolution**: We will work on a fix and aim to release a patch within:
  - 7 days for Critical severity
  - 14 days for High severity
  - 30 days for Medium severity
  - 90 days for Low severity
- **Disclosure**: We will coordinate public disclosure with you to ensure users have time to update

### Security Best Practices

When reporting vulnerabilities:

- Use PGP encryption for sensitive information
  ```
  -----BEGIN PGP PUBLIC KEY BLOCK-----
  [PGP key would be published here]
  -----END PGP PUBLIC KEY BLOCK-----
  ```
- Do not exploit the vulnerability beyond what's necessary for demonstration
- Do not access, modify, or delete data without permission
- Do not disclose the vulnerability publicly until we've addressed it
- Give us reasonable time to respond before considering public disclosure (typically 90 days)

## Scope

This security policy covers:

- The Velyx Registry Laravel application
- Component API endpoints
- Authentication and authorization systems
- Data storage and handling
- Webhooks and integrations

### Out of Scope

The following are explicitly out of scope:

- Third-party dependencies and vulnerabilities in them
- Issues requiring physical access to user's systems
- Social engineering attacks
- DDoS attacks
- Spam or rate limiting issues (unless they reveal a security vulnerability)

## Vulnerability Types

We're particularly interested in reports about:

- **Injection vulnerabilities** (SQL, NoSQL, OS command, etc.)
- **Authentication and authorization bypass**
- **Sensitive data exposure**
- **Cross-site scripting (XSS)**
- **Cross-site request forgery (CSRF)**
- **Remote code execution**
- **Insecure direct object references (IDOR)**
- **Security misconfigurations**
- **Insecure deserialization**
- **Logging and monitoring issues**

## Security Features

The Velyx Registry implements several security measures:

- Laravel's built-in CSRF protection
- Input validation and sanitization
- SQL injection protection via Eloquent ORM
- XSS protection via Blade templating
- Rate limiting on API endpoints
- Secure session management
- Environment-based configuration

## Security FAQ

**Q: Can I submit a security issue via GitHub?**
A: Please use encrypted email instead of GitHub issues to keep vulnerabilities private until they're fixed.

**Q: What if I don't receive a response?**
A: If you don't receive a response within 48 hours, please follow up. If another 48 hours passes without a response, you may escalate to [hello@velyx.dev](mailto:hello@velyx.dev).

**Q: Will I be credited for finding a vulnerability?**
A: Yes, with your permission, we'll credit you in the security advisory and our security hall of fame.

**Q: Do you offer a bug bounty program?**
A: We don't currently have a formal bug bounty program, but we do acknowledge and appreciate responsible disclosures.

**Q: Can I test the registry for vulnerabilities?**
A: Please only test your own instance or explicitly request permission before testing. Unauthorized testing of our production systems is prohibited.

## Dependency Security

We actively monitor our dependencies for security vulnerabilities:

- We use GitHub's Dependabot for automated dependency updates
- Security advisories will be published for vulnerable dependencies
- We aim to patch critical dependencies within 7 days of disclosure

## Preferred Languages

We prefer security reports in English, but can also work with reports in French if needed.

## Contact

For general security questions or concerns, contact us at:
- Email: [security@velyx.dev](mailto:security@velyx.dev)
- X (formerly Twitter): [@velyxdev](https://x.com/velyxdev)

Thank you for helping keep Velyx secure!
