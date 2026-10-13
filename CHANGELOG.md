# Changelog

## 3.0.0

- Replaced the jQuery and Bootstrap Datepicker browser dependency with native,
  dependency-free date controls and STL JavaScript behavior.
- Added shared CSS design tokens, responsive range layout, light/dark themes,
  localization hooks, lifecycle events, and range constraint coordination.
- Added optional Laravel configuration and asset publishing.

All notable changes to this project are documented here.

## Unreleased

### Changed

- Adopted the package as `software-technologies-limited/stl-date-picker-widget`.
- Rebuilt the package as a framework-agnostic PHP library for raw PHP, Laravel,
  Yii, Symfony, and other PHP applications.
- Removed Yii and all other PHP frameworks from runtime dependencies.
- Raised the minimum PHP version to 8.1.
- Updated bootstrap-datepicker to the 1.10 release line.
- Moved classes to the `Stl\DatePicker` namespace and introduced a
  direct rendering API.
- Replaced Travis CI with a PHP 8.1–8.5 GitHub Actions matrix.
- Updated development validation for current PHP releases.
- Replaced framework asset integration with configurable, pinned browser assets.
- Rewrote documentation while preserving original-project credit.

## 1.0.7 - 2017-07-05

Last release published by the original maintainers. See the Git history for
the complete earlier release history.
