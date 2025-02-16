<a href="{{ route('welcome') }}" class="flex items-center space-x-2">
    <svg width="300" height="100" viewBox="0 0 300 100" xmlns="http://www.w3.org/2000/svg"
         xmlns:xlink="http://www.w3.org/1999/xlink">
        <defs>
            <linearGradient id="textGradient" x1="0%" y1="0%" x2="0%" y2="100%">
                <stop offset="0%" stop-color="#33ffcf"/>
                <stop offset="100%" stop-color="#9933FF"/>
            </linearGradient>
            <filter id="dropShadow" x="-20%" y="-20%" width="140%" height="140%">
                <feOffset result="offOut" in="SourceAlpha" dx="3" dy="3"/>
                <feGaussianBlur result="blurOut" in="offOut" stdDeviation="2"/>
                <feBlend in="SourceGraphic" in2="blurOut" mode="normal"/>
            </filter>
        </defs>
        <text x="50%" y="50%" font-family="Arial, sans-serif" font-size="36" fill="url(#textGradient)"
              text-anchor="middle" dominant-baseline="middle" filter="url(#dropShadow)">{Mock: Wise}
        </text>
    </svg>
</a>
