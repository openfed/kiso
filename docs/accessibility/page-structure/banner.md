
Banner Landmark
==========

A `banner` landmark identifies site-oriented content at the beginning of each page within a website. Site-oriented content typically includes things such as the logo or identity of the site sponsor, and site-specific search tool. A banner usually appears at the top of the page and typically spans the full width.

## Design Patterns

* Each page may have one `banner` landmark.
* The `banner` landmark should be a top-level landmark.
* If a page includes more than one `banner` landmark, each should have a unique label.

## HTML5 Techniques

* The *HTML5* `header` element defines a `banner` landmark when its context is the `body` element.
* The *HTML5* `header` element is not considered as a `banner` landmark when it is descendant of any of following *HTML5* elements:
  * `article`
  * [`aside`](complementary.md)
  * [`main`](main.md)
  * [`nav`](navigation.md)
  * [`section`](region.md)

### HTML5 Example

Following markup snippet comes from the default "[Page](../../templates/page.html.twig.md)" *(TWIG template)*

```html
<!-- BEGIN OUTPUT from 'themes/contrib/kiso/templates/system/page.html.twig' -->
...
<div class="page__wrapper page__wrapper--header">
  <header class="page__section page__section--header container" role="banner">
    ...
  </header>
</div>
```