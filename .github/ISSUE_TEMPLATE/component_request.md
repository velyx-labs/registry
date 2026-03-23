---
name: Component request
about: Request a new component for the registry with enough detail to implement and validate it
title: "[COMPONENT] "
labels: enhancement, component, needs-triage
assignees: ""
---

## Summary

Name the component and describe its purpose.

## Problem / Use Case

Explain where this component is needed and what workflow it improves.

## Proposed API

Show the expected usage.

```php
<x-component-name />
```

## Required Behavior

List the minimum behavior this component must support.

- [ ] Default state
- [ ] Variants or sizes
- [ ] Disabled or empty state
- [ ] Form integration
- [ ] Alpine behavior
- [ ] Livewire compatibility

## Structure Expectations

Describe the expected files or delivery constraints if relevant.

- Blade structure:
- JavaScript requirement:
- CSS requirement:
- External dependencies:

## Accessibility Requirements

Describe the accessibility expectations.

- [ ] Keyboard support
- [ ] Focus management
- [ ] ARIA semantics
- [ ] Screen reader support
- [ ] Reduced motion considerations

## References

Link similar components or design references.

- shadcn/ui:
- Tailwind UI:
- Other:

## Validation Plan

How should we verify the component once implemented?

- [ ] Registry preview required
- [ ] Docs page required
- [ ] CLI install path required
- [ ] Tests required

## Scope Check

- [ ] I checked that this component is not already in the registry
- [ ] I described the API and expected behavior clearly
- [ ] I included references or concrete examples

## Additional Context

Anything else that would reduce ambiguity for implementation.
