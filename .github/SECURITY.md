# Security Policy

## Supported Versions

Security fixes are provided for the current maintained registry version.

| Version | Supported |
| --- | --- |
| Latest | Yes |

## Reporting a Vulnerability

Do not open a public GitHub issue for security problems.

Report vulnerabilities privately at [security@velyx.dev](mailto:security@velyx.dev).

Include:

- a clear description of the issue
- exact reproduction steps
- affected endpoints, pages, or components
- expected impact
- a proof of concept if it is necessary to validate the report

## Scope

This policy covers issues in this repository, including:

- registry API endpoints and responses
- component metadata validation and delivery
- preview rendering and preview source output
- application auth, sessions, or sensitive data exposure
- server-side behavior shipped by this repository

## Out of Scope

The following are generally out of scope:

- vulnerabilities in third-party packages themselves
- external infrastructure not managed by this repository
- local environment issues with no repo-specific exploit path
- physical access, spam, or social engineering reports

## Response Expectations

- acknowledgement within 48 hours
- triage and validation of impact
- coordinated fix and disclosure when appropriate

## Reporter Guidance

- do not disclose the issue publicly before a fix is available
- do not access or alter data you do not own
- keep proofs of concept minimal and targeted

## Contact

- Security: [security@velyx.dev](mailto:security@velyx.dev)
- Fallback: [hello@velyx.dev](mailto:hello@velyx.dev)
