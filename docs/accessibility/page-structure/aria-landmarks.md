
ARIA Landmarks
==========

Landmarks provide a powerful way to identify the organization and structure of a web page. The structural information conveyed visually to users should be represented programmatically in the markup using landmark roles. The use of landmarks roles support keyboard navigation to the structure of a web page for screen reader users, and can be used as targets for author supplied "skip links" and browser extensions for enhanced keyboard navigation.

This section is intended to assist developers in defining and understanding the importance of logical, usable, and accessible layout for assistive technologies using *HTML5* sectioning elements and *ARIA* landmark roles.

Due to the complexity of todays web content, if using landmarks, **all content** should reside in a semantically meaningful landmark in order that content is not missed by the user.

## Step 1: Identify the logical structure

* Break the page into perceivable areas called "**areas**".
* Examples of **areas** can be found in the "*[Page](../../templates/page.html.twig.md)*" *(TWIG)* template.
* Typically, designers indicate **areas** visually using alignment and spacing of content.
* **[Region](region.md)** can be further defined into logical *sub-areas* as needed.
* An example of a **[region](region.md)** is the default "*[Block](../../templates/block.html.twig.md)*" *(TWIG)* template in a Drupal website or application.

## Step 2: Assign landmark roles to each area/region

* Assign landmark roles based on the type of content in the area.
* [`banner`](banner.md), [`main`](main.md), [`complementary`](complementary.md) and [`contentinfo`](contentinfo.md) landmarks should be top level landmarks.
* Landmark roles can be nested to identify parent/child relationships of the information being presented.
* Use the [`region`](region.md) landmark role on the wrapper of the default "*[Block](../../templates/block.html.twig.md)*" *(TWIG)* template.

## Step 3: Label each area/region

* If a specific landmark role is used more than once on a web page, it should have a unique label.
* If a [region](region.md) begins with a heading element (e.g. `h2-h6`), it can be used as the label for the [region](region.md) using `aria-labelledby` attribute.
* If a [region](region.md) does not have a heading element, provide a label using the `aria-label` attribute.
* Avoid using the landmark role as part of the label. For example, a [`navigation`](navigation.md) landmark with a label *"Main navigation"* will be announced by a screen reader as *"Main navigation Navigation"*. The label should simply be *"Main"* (or *"Main menu"* if necessary).