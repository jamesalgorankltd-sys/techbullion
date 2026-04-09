import Link from "next/link"
import { Twitter, Linkedin, Github, Youtube, Mail, ArrowUpRight } from "lucide-react"

const footerLinks = {
  company: [
    { name: "About Us", href: "/about" },
    { name: "Contact", href: "/contact" },
    { name: "Careers", href: "#" },
    { name: "Press Kit", href: "#" },
  ],
  resources: [
    { name: "Blog", href: "/blog" },
    { name: "Tutorials", href: "#" },
    { name: "Documentation", href: "#" },
    { name: "Newsletter", href: "#" },
  ],
  legal: [
    { name: "Privacy Policy", href: "#" },
    { name: "Terms of Service", href: "#" },
    { name: "Cookie Policy", href: "#" },
  ],
}

const socialLinks = [
  { icon: Twitter, href: "#", label: "Twitter" },
  { icon: Linkedin, href: "#", label: "LinkedIn" },
  { icon: Github, href: "#", label: "GitHub" },
  { icon: Youtube, href: "#", label: "YouTube" },
]

export function Footer() {
  return (
    <footer className="relative bg-[#0a0a0a] border-t border-[#222] overflow-hidden">
      {/* Background Effects */}
      <div className="absolute inset-0 grid-pattern opacity-30" />
      <div className="absolute bottom-0 left-1/4 w-96 h-96 bg-[#00ff88]/5 rounded-full blur-3xl" />
      <div className="absolute top-0 right-1/4 w-64 h-64 bg-[#00ccff]/5 rounded-full blur-3xl" />

      <div className="container mx-auto px-6 py-16 relative z-10">
        {/* Main Footer Content */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 mb-16">
          {/* Brand Column */}
          <div className="lg:col-span-2">
            <Link href="/" className="inline-flex items-center gap-3 mb-6">
              <div className="w-10 h-10 rounded-lg bg-[#00ff88] flex items-center justify-center">
                <span className="text-[#0a0a0a] font-bold text-xl">T</span>
              </div>
              <span className="text-xl font-bold text-white">
                Tech<span className="text-[#00ff88]">Bullion</span>
              </span>
            </Link>
            <p className="text-white/60 mb-6 max-w-sm leading-relaxed">
              Your trusted source for the latest in technology news, insights, and innovation. 
              Empowering readers with knowledge that shapes tomorrow.
            </p>
            <div className="flex gap-4">
              {socialLinks.map((social) => (
                <a
                  key={social.label}
                  href={social.href}
                  className="w-10 h-10 rounded-lg bg-[#1a1a1a] border border-[#333] flex items-center justify-center text-white/60 hover:text-[#00ff88] hover:border-[#00ff88]/50 transition-all hover:scale-110"
                  aria-label={social.label}
                >
                  <social.icon size={18} />
                </a>
              ))}
            </div>
          </div>

          {/* Links Columns */}
          <div>
            <h4 className="text-white font-semibold mb-4">Company</h4>
            <ul className="space-y-3">
              {footerLinks.company.map((link) => (
                <li key={link.name}>
                  <Link
                    href={link.href}
                    className="text-white/60 hover:text-[#00ff88] transition-colors inline-flex items-center gap-1 group"
                  >
                    {link.name}
                    <ArrowUpRight size={14} className="opacity-0 -translate-y-1 translate-x-1 group-hover:opacity-100 group-hover:translate-y-0 group-hover:translate-x-0 transition-all" />
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          <div>
            <h4 className="text-white font-semibold mb-4">Resources</h4>
            <ul className="space-y-3">
              {footerLinks.resources.map((link) => (
                <li key={link.name}>
                  <Link
                    href={link.href}
                    className="text-white/60 hover:text-[#00ff88] transition-colors inline-flex items-center gap-1 group"
                  >
                    {link.name}
                    <ArrowUpRight size={14} className="opacity-0 -translate-y-1 translate-x-1 group-hover:opacity-100 group-hover:translate-y-0 group-hover:translate-x-0 transition-all" />
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          <div>
            <h4 className="text-white font-semibold mb-4">Legal</h4>
            <ul className="space-y-3">
              {footerLinks.legal.map((link) => (
                <li key={link.name}>
                  <Link
                    href={link.href}
                    className="text-white/60 hover:text-[#00ff88] transition-colors inline-flex items-center gap-1 group"
                  >
                    {link.name}
                    <ArrowUpRight size={14} className="opacity-0 -translate-y-1 translate-x-1 group-hover:opacity-100 group-hover:translate-y-0 group-hover:translate-x-0 transition-all" />
                  </Link>
                </li>
              ))}
            </ul>
          </div>
        </div>

        {/* Newsletter Section */}
        <div className="glass rounded-2xl p-8 mb-16">
          <div className="flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
              <h3 className="text-xl font-bold text-white mb-2">Stay Updated</h3>
              <p className="text-white/60">Get the latest tech news delivered to your inbox.</p>
            </div>
            <div className="flex gap-3 w-full md:w-auto">
              <input
                type="email"
                placeholder="Enter your email"
                className="flex-1 md:w-64 px-4 py-3 bg-[#1a1a1a] border border-[#333] rounded-lg text-white placeholder:text-white/40 focus:outline-none focus:border-[#00ff88]/50 transition-colors"
              />
              <button className="px-6 py-3 bg-[#00ff88] text-[#0a0a0a] font-semibold rounded-lg hover:bg-[#00ff88]/90 transition-all hover:shadow-[0_0_30px_rgba(0,255,136,0.3)]">
                Subscribe
              </button>
            </div>
          </div>
        </div>

        {/* Bottom Bar */}
        <div className="flex flex-col md:flex-row items-center justify-between gap-4 pt-8 border-t border-[#222]">
          <p className="text-white/40 text-sm">
            Copyright &copy; {new Date().getFullYear()} TechBullion. All rights reserved.
          </p>
          <div className="flex items-center gap-6 text-sm">
            <Link href="#" className="text-white/40 hover:text-white/80 transition-colors">
              Privacy Policy
            </Link>
            <Link href="#" className="text-white/40 hover:text-white/80 transition-colors">
              Terms of Service
            </Link>
          </div>
        </div>
      </div>
    </footer>
  )
}
