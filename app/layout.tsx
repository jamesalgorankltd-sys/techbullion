import type { Metadata, Viewport } from 'next'
import { Inter, Space_Grotesk } from 'next/font/google'
import { Analytics } from '@vercel/analytics/next'
import './globals.css'

const inter = Inter({ 
  subsets: ["latin"],
  variable: "--font-inter",
  display: "swap",
})

const spaceGrotesk = Space_Grotesk({ 
  subsets: ["latin"],
  variable: "--font-space-grotesk",
  display: "swap",
})

export const metadata: Metadata = {
  title: 'TechBullion - Your Gateway to Tech Innovation',
  description: 'TechBullion delivers cutting-edge insights, in-depth analysis, and breaking news from the world of technology, AI, blockchain, and digital innovation.',
  keywords: ['technology', 'tech news', 'AI', 'blockchain', 'innovation', 'startups', 'cybersecurity'],
  authors: [{ name: 'TechBullion' }],
  openGraph: {
    title: 'TechBullion - Your Gateway to Tech Innovation',
    description: 'Cutting-edge insights and breaking news from the world of technology',
    type: 'website',
    locale: 'en_US',
    siteName: 'TechBullion',
  },
  twitter: {
    card: 'summary_large_image',
    title: 'TechBullion - Your Gateway to Tech Innovation',
    description: 'Cutting-edge insights and breaking news from the world of technology',
  },
}

export const viewport: Viewport = {
  themeColor: '#0a0a0a',
  width: 'device-width',
  initialScale: 1,
}

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode
}>) {
  return (
    <html lang="en">
      <body className={`${inter.variable} ${spaceGrotesk.variable} font-sans antialiased bg-[#0a0a0a] text-white`}>
        {children}
        {process.env.NODE_ENV === 'production' && <Analytics />}
      </body>
    </html>
  )
}
