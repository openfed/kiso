CHANGELOG
=========

20 January 2026 - Version 4.0.1
-------------------------------
- Fixed #151: Only the current page can have the aria-current attribute on language links

09 December 2025 - Version 4.0.0
-------------------------------
- Fixed #146: Update path to override the extlink library after module upgrade

09 December 2025 - Version 3.1.2
-------------------------------
- Fixed #143: Different accessibility approach with pager ellipsis links not having discernible text
- Fixed #148: Add accessible text to image formatter links

17 October 2025 - Version 3.1.1
-------------------------------
- Fixed #143: Accessibility issue with pager ellipsis links not having discernible text

10 September 2025 - Version 3.1.0
---------------------------------
- Fixed #133: Warning: undefined array key "navigation" and "complementary"
- Fixed #137: Incorrect retrieval of node object from route parameter results in warning
- Fixed #141: In some cases language links where not showing if there was no translation available (instead of being disabled)
- Changed functionality introduced by #99 to only generate unique form ID for views exposed forms. Drupal takes care of the other ones.
- Issue #136: Added extra warning in the theme settings concerning compatibility with External Links (New Window)
