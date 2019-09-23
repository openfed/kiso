
Overview and Limitations
==========

The overall accessibility of any project built with ***Drupal Kiso (基礎)*** depends in large part on the author’s markup, additional styling, and scripting they’ve included. However, provided that these have been implemented correctly, it should be perfectly possible to create websites and applications with ***Drupal Kiso (基礎)*** that fulfill [WCAG 2.1](https://www.w3.org/TR/WCAG21/) (A/AA/AAA) and similar accessibility standards and requirements.

## Structural markup

***Drupal Kiso (基礎)*** templates and styles can be applied to a wide range of markup structures. This documentation aims to provide developers with best-practice examples to demonstrate the use of ***Drupal Kiso (基礎)*** itself and illustrate appropriate semantic markup, including ways in which potential accessibility concerns can be addressed.

## Interactive components

***Drupal Kiso (基礎)*** interactive components are designed to work for touch, mouse and keyboard users. Through the use of relevant [WAI-ARIA](https://www.w3.org/WAI/intro/aria) roles and attributes, these components should also be understandable and operable using assistive technologies (such as screen readers).

## Color contrast

Most colors that currently make up ***Drupal Kiso (基礎)*** default palette (used throughout the [Framework SASS](https://github.com/smillart/Framework-SASS-Source-Files) source files for things such as *button variations*, *alert variations* ...) lead to *sufficient* color contrast (compliant with the recommended [WCAG 2.1 color contrast ratio of 4.5:1](https://www.w3.org/WAI/WCAG21/Techniques/general/G18) and [WCAG 2.1 color contrast ratio of 3:1](https://www.w3.org/WAI/WCAG21/Techniques/general/G145)) when used against a white back(fore)ground. If modified, authors will need to manually modify/extend these default colors to ensure adequate color contrast ratios.

## Relationship to WCAG 2.1

Each ***Drupal Kiso (基礎)*** [templates](https://github.com/openfed/kiso/tree/master/templates/) provide best-practice guidance on implementing accessibility in different situations. They combine *WCAG 2.1* success criteria and techniques from various conformance levels. Each template file lists the specific success criteria and techniques used on that specific template. A more comprehensive coverage of the normative [WCAG 2.1 standard](https://www.w3.org/TR/WCAG21/) and its supporting materials is provided in **[How to Meet WCAG 2: A customizable quick reference](https://www.w3.org/WAI/WCAG21/quickref/)**.