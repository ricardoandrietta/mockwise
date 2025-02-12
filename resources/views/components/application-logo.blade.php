<svg width="300" height="100" viewBox="0 0 300 100" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <defs>
        <linearGradient id="textGradient" x1="0%" y1="0%" x2="0%" y2="100%">
            <stop offset="0%" stop-color="#33BFFF"/>
            <stop offset="100%" stop-color="#9933FF"/>
        </linearGradient>
        <filter id="dropShadow" x="-20%" y="-20%" width="140%" height="140%">
            <feOffset result="offOut" in="SourceAlpha" dx="3" dy="3"/>
            <feGaussianBlur result="blurOut" in="offOut" stdDeviation="2"/>
            <feBlend in="SourceGraphic" in2="blurOut" mode="normal"/>
        </filter>
    </defs>
    <!-- Rectangle with rounded corners -->
    <rect x="5" y="5" width="290" height="90" rx="10" ry="10" fill="white" stroke-width="2" fill-opacity="0.1"/>
    <!-- Text -->
    <text x="50%" y="50%" font-family="Arial, sans-serif" font-size="36" fill="url(#textGradient)" text-anchor="middle" dominant-baseline="middle" filter="url(#dropShadow)">{Mock: Wise}</text>
</svg>
