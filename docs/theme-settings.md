
Theme Settings
==========

## General > Container

| Setting name | Description and default value |
|:--|:--|
| **container_fluid** | Uses the `.container-fluid` class instead of `.container` class.<br>`container_fluid: 0` |

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