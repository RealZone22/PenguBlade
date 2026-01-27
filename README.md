<h3 align="center">PenguBlade</h3>

  <p align="center">
    PenguBlade is a collection of Blade components designed to enhance your Laravel applications with beautiful and functional UI elements.
    <br />
    <a href="https://github.com/RealZone22/PenguBlade/wiki"><strong>📖 Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/RealZone22/PenguBlade/issues/new?labels=bug&template=bug.yml">🐛 Report Bug</a>
    ·
    <a href="https://github.com/RealZone22/PenguBlade/discussions/new?category=ideas">✨ Request Feature</a>
    ·
    <a href="https://github.com/RealZone22/PenguBlade/discussions/new?category=q-a">❓ Ask a question</a>
  </p>

<div align="center">
    <a href="https://github.com/RealZone22/PenguBlade/graphs/contributors" alt="Contributors">
        <img src="https://img.shields.io/github/contributors/RealZone22/PenguBlade.svg?style=for-the-badge" />
    </a>
    <a href="https://github.com/RealZone22/PenguBlade/network/members" alt="Forks">
        <img src="https://img.shields.io/github/forks/RealZone22/PenguBlade.svg?style=for-the-badge" />
    </a>
    <a href="https://github.com/RealZone22/PenguBlade/network/stargazers" alt="Stars">
        <img src="https://img.shields.io/github/stars/RealZone22/PenguBlade.svg?style=for-the-badge" />
    </a>
    <a href="https://github.com/RealZone22/PenguBlade/issues" alt="Issues">
        <img src="https://img.shields.io/github/issues/RealZone22/PenguBlade.svg?style=for-the-badge" />
    </a>
    <a href="https://packagist.org/packages/realzone22/pengublade" alt="Downloads">
        <img src="https://img.shields.io/packagist/dt/realzone22/pengublade.svg?style=for-the-badge" />
    </a>
</div>

<div align="center">

## Features

- 🎨 **Beautiful UI Components** - Based on PenguinUI design system
- 📱 **Responsive Design** - Works perfectly on all screen sizes
- 🌙 **Dark Mode Support** - Built-in dark mode compatibility
- ⚡ **Livewire Integration** - Seamless Livewire component support
- 📊 **File Upload Progress** - Real-time file upload progress indicators
- 🎯 **Accessibility** - WCAG compliant components
- 🔧 **Customizable** - Easy to customize with Tailwind CSS

## File Upload Components

PenguBlade now includes advanced file upload components with progress bar support:

### Basic File Upload with Progress

```blade
<x-file.upload 
    label="Choose a file"
    hint="Maximum file size: 5MB"
    max-size="5120"
    show-progress
    progress-color="primary" />
```

### Livewire File Upload

```blade
<x-file.livewire-upload 
    label="Upload document"
    upload-property="document"
    show-progress
    progress-color="success" />
```

### Multiple File Upload

```blade
<x-file.upload 
    label="Choose multiple files"
    multiple
    show-progress
    progress-color="info" />
```

#### Features:
- ✅ Real-time progress tracking
- ✅ File size validation
- ✅ Multiple file support
- ✅ Livewire integration
- ✅ Upload speed calculation
- ✅ Time remaining estimation
- ✅ Customizable progress colors
- ✅ Error handling

## Security Vulnerabilities

Please review [our security policy](SECURITY.md) on how to report security vulnerabilities.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
</div>
