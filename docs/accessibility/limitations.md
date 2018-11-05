
Overview and Limitations
==========

The overall accessibility of any project built with *Kiso* depends in large part on the author’s markup, additional styling, and scripting they’ve included. However, provided that these have been implemented correctly, it should be perfectly possible to create websites and applications with *Kiso* that fulfill [WCAG 2.0](https://www.w3.org/TR/WCAG20/) (A/AA/AAA) and similar accessibility standards and requirements.

## Structural markup

*Kiso*’s templates and styles can be applied to a wide range of markup structures. This documentation aims to provide developers with best-practice examples to demonstrate the use of *Kiso* itself and illustrate appropriate semantic markup, including ways in which potential accessibility concerns can be addressed.

## Interactive components

*Kiso*’s interactive components are designed to work for touch, mouse and keyboard users. Through the use of relevant [WAI-ARIA](https://www.w3.org/WAI/intro/aria) roles and attributes, these components should also be understandable and operable using assistive technologies (such as screen readers).

## Color contrast

Most colors that currently make up *Kiso*’s default palette (used throughout the framework for things such as button variations, alert variations ...) lead to *sufficient* color contrast (compliant with the recommended [WCAG 2.0 color contrast ratio of 4.5:1](https://www.w3.org/TR/UNDERSTANDING-WCAG20/visual-audio-contrast-contrast.html)) when used against a white back(fore)ground. If modified, authors will need to manually modify/extend these default colors to ensure adequate color contrast ratios.

## Relationship to WCAG 2.0

This topic provides best-practice guidance on implementing accessibility in different situations. They combine *WCAG 2.0* success criteria and techniques from various conformance levels. Each best-practice page lists the specific success criteria and techniques used on that page. A more comprehensive coverage of the normative [WCAG 2.0 standard](https://www.w3.org/TR/WCAG20/) and its supporting materials is provided in **[How to Meet WCAG 2.0: A customizable quick reference](https://www.w3.org/WAI/WCAG20/quickref/)**.