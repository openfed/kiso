
Theme Settings
==========

## General > Container

| Setting name | Description and default value |
|:--|:--|
| **container_fluid** | Uses the `.container-fluid` class instead of `.container` class.<br>`container_fluid: 0` |

## JavaScript > Keyboard Focus Tracking

The _Keyboard Focus Tracking_ is based on the [_What Input_](https://github.com/ten1seven/what-input) GitHub library, a global utility for tracking the current input method (mouse, keyboard or touch).

**Note:** Since interacting with a form always requires use of the keyboard, _What Input_ uses the `data-whatintent` attribute to display a "buffered" version of input events while form `<input>`s, `<select>`s, and `<textarea>`s are being interacted with (i.e. mouse user's `data-whatintent` will be preserved as `mouse` while typing).

| Setting name | Description and default value |
|:--|:--|
| **trackfocus_enable** | Display a unique highly visible _keyboard only_ focus indicator **for all focusable elements** using a combination of a highly contrasting style.<br>`trackfocus_enable: 0` |
| **trackfocus_disable_persist** | By default, _What Input_ uses [session storage](https://developer.mozilla.org/en-US/docs/Web/API/Window/sessionStorage) to persist the input and intent values across pages. The benefit is that once a visitor has interacted with the page, subsequent pages won't have to wait for interactions to know the input method.<br>`trackfocus_disable_persist: 0` |

## JavaScript > Outdated Browser

[Outdated Browser](http://outdatedbrowser.com/en) is a time saving tool for developers. With this solution it will be possible to check if the user’s _Microsoft_ browser can handle your website. If not, it will show a notice advising the user to update his browser for latest versions. It will be up to the user to upgrade... or not.

| Setting name | Description and default value |
|:--|:--|
| **outdatedbrowser_enable** | Detect outdated _Microsoft Internet Explorer_ browsers and advise users to upgrade to a new version.<br>`outdatedbrowser_enable: 0` |
| **outdatedbrowser_ie_target** | Select the _Microsoft Internet Explorer_ versions that will trigger the warning message display (e.g. "IE 11 and lower" for IE 11, 10, 9 and 8 browser versions at least).<br>`outdatedbrowser_ie_target: '9'` |

### CSS MATCHING

Use CSS selectors to only look inside explicitly or exclude entirely specified `<body>` classes which will identify specific Website pages to trigger the warning message display.

| Setting name | Description and default value |
|:--|:--|
| **outdatedbrowser_css_explicit** | Enter a comma-separated list of CSS selectors (e.g. `.page--frontpage`, `.page--node-type-news`, `.not-logged-in`).<br>`outdatedbrowser_css_explicit: ''` |
| **outdatedbrowser_css_exclude** | Enter a comma-separated list of CSS selectors (e.g. .page--contact, .logged-in, .no-sidebars).<br>`outdatedbrowser_css_exclude: ''` |

## JavaScript > External Links (New Window)

Extends the Drupal "[External Links  _(extlink 8.x-1.2)_](https://www.drupal.org/project/extlink)" contributed module giving users advanced warning when opening in a new window or tab.

| Setting name | Description and default value |
|:--|:--|
| **extlinkwindow_enabled** | Enable the "External Links" (New Window) behavior for links that open in a new window.<br>`extlinkwindow_enabled: 1` |
| **extlinkwindow_extlink_custom_label** | If you check this box you can choose which message will be used to warn users when the external links open in a new window.<br>`extlinkwindow_extlink_custom_label: 0` |
| **extlinkwindow_extlink_label** | Change the warning message of the external links opening in a new window if needed. Default value is "(link is external and opens a new window)".<br>`extlinkwindow_extlink_label: '(link is external and opens a new window)'` |
| **extlinkwindow_intlink_enabled** | Checking this box will automatically include all other links having the same domain (internal) and which open in a new window.<br>`extlinkwindow_intlink_enabled: 0` |
| **extlinkwindow_intlink_custom_label** | If you check this box you can choose which message will be used to warn users when the internal links open in a new window.<br>`extlinkwindow_intlink_custom_label: 0` |
| **extlinkwindow_intlink_label** | Change the warning message of the internal links opening in a new window if needed. Default value is "(link opens a new window)".<br>`extlinkwindow_intlink_label: '(link opens a new window)'` |
| **extlinkwindow_font_awesome_custom_class** | Checking this box will allow you to customize the Font Awesome icon (used instead of SVG image) for links opening in a new window (see the "External Links" settings page).<br>`extlinkwindow_font_awesome_custom_class: 0` |
| **extlinkwindow_font_awesome_class** | Font Awesome icon class (links opening in a new window):<br>`extlinkwindow_font_awesome_class: 'fas fa-window-restore'` |

## JavaScript > Tooltip

**[Tooltip Widget](https://www.w3.org/TR/wai-aria-practices-1.1/#tooltip)** are popups that display information related to a **Semantic (Web Font) Icon** when it receives keyboard focus or the mouse hovers over it. It typically appears after a small delay and disappears when `Escape` is pressed or on mouse out. **[Semantic Icons](https://www.w3.org/WAI/WCAG21/Techniques/aria/ARIA24.html)** are ones that you are using to convey meaning, rather than just pure decoration.

| Setting name | Description and default value |
|:--|:--|
| **tooltip_enabled** | Elements that have `[role="img"][aria-label]` or `[data-pattern="tooltip"][title]` attributes set will automatically initialize the tooltip upon page load.<br>`tooltip_enabled: 1` |
| **tooltip_delay** | The amount of time to delay showing the tooltip (in milliseconds).<br>`tooltip_delay: 600` |

## JavaScript > Back to Top

| Setting name | Description and default value |
|:--|:--|
| **backtotop_enable** | Enable the back to top button.<br>`backtotop_enable: 0` |
| **backtotop_label** | Change title of the link if needed. Default value is "Back to top".<br>`backtotop_label: 'Back to top'` |
| **backtotop_offset** | The offset coordinates is used to set after how many pixels of scrolling the link will appear. Default value is 300.<br>`backtotop_offset: 300` |
| **backtotop_mobile_hide** | By checking this box, the back to top link won't appear on smaller devices according to the site's responsive breakpoints.<br>`backtotop_mobile_hide: 1` |

## JavaScript > Smooth Scroll

| Setting name | Description and default value |
|:--|:--|
| **smoothscroll_enable** | Enable the smooth scroll behavior for anchor links.<br>`smoothscroll_enable: 1` |
