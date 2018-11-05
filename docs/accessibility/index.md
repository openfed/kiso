
Accessibility
==========

Drupal "*Kiso*" (基礎) base theme provides an easy-to-use framework of ready-made templates, layout tools, styles and interactive components, allowing developers and content managers to create Drupal websites and applications that are visually appealing, functionally rich, and accessible out of the box.

This documentation covers various accessibility topics, based on common tasks in web projects. It shows how to develop web content that is accessible to people with disabilities, and that provides a better user experience for everyone.

Please read first the brief [overview of Kiso’s limitations](limitations.md) for the creation of accessible content.

## Page Structure

### ARIA Landmarks

Well-structured content allows more efficient navigation and processing. [Take a look at **ARIA landmarks** general concepts](page-structure/aria-landmarks.md) and combine them with **HTML5 sectioning elements** to improve navigation and orientation on web pages and in applications.

* [Banner Landmark](page-structure/banner.md) :  
A `banner` landmark identifies site-oriented content (such as website logo, search function, navigation options ...) at the beginning of each page within a website.

* [Search Landmark](page-structure/search.md) :  
A `search` landmark identifies the search functionality to global content on the website.

* [Main Landmark](page-structure/main.md) :  
A `main` landmark identifies the primary content of the page.

* [Complementary Landmark](page-structure/complementary.md) :  
A `complementary` landmark is designed to be complementary to the main content at a similar level in the DOM hierarchy.

* [Navigation Landmark](page-structure/navigation.md) :  
A `navigation` landmark identifies website or page content navigation.

* [Region Landmark](page-structure/region.md) :  
A `region` landmark is a perceivable section containing content that is relevant to a specific topic.

* [Contentinfo Landmark](contentinfo.md) :  
A contentinfo landmark identifies  the region site-oriented information (such as copyright information, privacy statements or disclaimers ...) at the bottom of every page.