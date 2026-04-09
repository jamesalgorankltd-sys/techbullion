"use client"

import { useState } from "react"
import { Header } from "@/components/layout/header"
import { Footer } from "@/components/layout/footer"
import { Mail, MapPin, Phone, Send, MessageSquare, Users, FileText, Clock } from "lucide-react"
import { Button } from "@/components/ui/button"

const contactInfo = [
  {
    icon: Mail,
    title: "Email Us",
    value: "ahmadmalikcore@gmail.com",
    description: "For general inquiries",
  },
  {
    icon: MapPin,
    title: "Our Office",
    value: "San Francisco, CA",
    description: "Silicon Valley HQ",
  },
  {
    icon: Phone,
    title: "Call Us",
    value: "+92 (305) 667362-6",
    description: "Mon-Fri 9am-6pm PST",
  },
  {
    icon: Clock,
    title: "Response Time",
    value: "24-48 Hours",
    description: "We respond quickly",
  },
]

const inquiryTypes = [
  { value: "general", label: "General Inquiry", icon: MessageSquare },
  { value: "partnership", label: "Partnership", icon: Users },
  { value: "advertising", label: "Advertising", icon: FileText },
  { value: "press", label: "Press & Media", icon: Mail },
]

export default function ContactPage() {
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    company: "",
    phone: "",
    inquiryType: "general",
    message: "",
  })
  const [isSubmitting, setIsSubmitting] = useState(false)
  const [isSubmitted, setIsSubmitted] = useState(false)

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) => {
    setFormData((prev) => ({
      ...prev,
      [e.target.name]: e.target.value,
    }))
  }

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault()
    setIsSubmitting(true)
    
    // Simulate form submission
    await new Promise((resolve) => setTimeout(resolve, 1500))
    
    setIsSubmitting(false)
    setIsSubmitted(true)
    setFormData({
      name: "",
      email: "",
      company: "",
      phone: "",
      inquiryType: "general",
      message: "",
    })
  }

  return (
    <main className="min-h-screen bg-[#0a0a0a]">
      <Header />

      {/* Hero Section */}
      <section className="relative pt-32 pb-20 overflow-hidden">
        <div className="absolute inset-0 grid-pattern opacity-30" />
        <div className="absolute top-1/4 left-1/4 w-96 h-96 bg-[#00ff88]/10 rounded-full blur-[120px]" />
        <div className="absolute bottom-1/4 right-1/4 w-80 h-80 bg-[#00ccff]/10 rounded-full blur-[100px]" />

        <div className="container mx-auto px-6 relative z-10">
          <div className="max-w-4xl mx-auto text-center">
            <span className="inline-block text-[#00ff88] text-sm font-semibold tracking-wider uppercase mb-4">
              Contact Us
            </span>
            <h1 className="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
              Work with <span className="gradient-text">TechBullion</span>
            </h1>
            <p className="text-white/60 text-lg md:text-xl leading-relaxed max-w-2xl mx-auto">
              Have a question, partnership opportunity, or just want to say hello? 
              We&apos;d love to hear from you.
            </p>
          </div>
        </div>
      </section>

      {/* Contact Info Cards */}
      <section className="py-16 border-y border-[#222]">
        <div className="container mx-auto px-6">
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {contactInfo.map((info, index) => (
              <div
                key={index}
                className="group p-6 glass rounded-xl transition-all duration-300 hover:border-[#00ff88]/30"
              >
                <div className="w-12 h-12 rounded-lg bg-[#00ff88]/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                  <info.icon className="w-6 h-6 text-[#00ff88]" />
                </div>
                <h3 className="text-sm text-white/50 mb-1">{info.title}</h3>
                <p className="text-lg font-semibold text-white mb-1">{info.value}</p>
                <p className="text-sm text-white/50">{info.description}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Contact Form Section */}
      <section className="py-32 relative overflow-hidden">
        <div className="absolute inset-0 grid-pattern opacity-30" />

        <div className="container mx-auto px-6 relative z-10">
          <div className="max-w-4xl mx-auto">
            <div className="grid grid-cols-1 lg:grid-cols-5 gap-12">
              {/* Left Side - Info */}
              <div className="lg:col-span-2">
                <h2 className="text-3xl font-bold text-white mb-6">
                  Let&apos;s Start a Conversation
                </h2>
                <p className="text-white/60 leading-relaxed mb-8">
                  Whether you&apos;re interested in advertising, partnerships, or contributing to TechBullion, 
                  we&apos;re here to help. Fill out the form and our team will get back to you shortly.
                </p>

                {/* Inquiry Types */}
                <div className="space-y-4">
                  <h3 className="text-sm font-semibold text-white/80 uppercase tracking-wider">
                    How can we help?
                  </h3>
                  {inquiryTypes.map((type) => (
                    <div
                      key={type.value}
                      className={`flex items-center gap-3 p-3 rounded-lg cursor-pointer transition-all ${
                        formData.inquiryType === type.value
                          ? "bg-[#00ff88]/10 border border-[#00ff88]/30"
                          : "bg-[#1a1a1a] border border-[#333] hover:border-[#00ff88]/20"
                      }`}
                      onClick={() => setFormData((prev) => ({ ...prev, inquiryType: type.value }))}
                    >
                      <type.icon
                        className={`w-5 h-5 ${
                          formData.inquiryType === type.value ? "text-[#00ff88]" : "text-white/50"
                        }`}
                      />
                      <span
                        className={formData.inquiryType === type.value ? "text-white" : "text-white/70"}
                      >
                        {type.label}
                      </span>
                    </div>
                  ))}
                </div>
              </div>

              {/* Right Side - Form */}
              <div className="lg:col-span-3">
                {isSubmitted ? (
                  <div className="glass rounded-2xl p-12 text-center">
                    <div className="w-20 h-20 rounded-full bg-[#00ff88]/10 flex items-center justify-center mx-auto mb-6">
                      <Send className="w-10 h-10 text-[#00ff88]" />
                    </div>
                    <h3 className="text-2xl font-bold text-white mb-4">Message Sent!</h3>
                    <p className="text-white/60 mb-6">
                      Thank you for reaching out. Our team will get back to you within 24-48 hours.
                    </p>
                    <Button
                      onClick={() => setIsSubmitted(false)}
                      variant="outline"
                      className="border-[#333] bg-transparent text-white hover:bg-white/5 hover:border-[#00ff88]/50"
                    >
                      Send Another Message
                    </Button>
                  </div>
                ) : (
                  <form onSubmit={handleSubmit} className="glass rounded-2xl p-8">
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                      {/* Name */}
                      <div>
                        <label htmlFor="name" className="block text-sm font-medium text-white/80 mb-2">
                          Full Name *
                        </label>
                        <input
                          type="text"
                          id="name"
                          name="name"
                          value={formData.name}
                          onChange={handleChange}
                          required
                          className="w-full px-4 py-3 bg-[#1a1a1a] border border-[#333] rounded-lg text-white placeholder:text-white/40 focus:outline-none focus:border-[#00ff88]/50 transition-colors"
                          placeholder="John Doe"
                        />
                      </div>

                      {/* Email */}
                      <div>
                        <label htmlFor="email" className="block text-sm font-medium text-white/80 mb-2">
                          Email Address *
                        </label>
                        <input
                          type="email"
                          id="email"
                          name="email"
                          value={formData.email}
                          onChange={handleChange}
                          required
                          className="w-full px-4 py-3 bg-[#1a1a1a] border border-[#333] rounded-lg text-white placeholder:text-white/40 focus:outline-none focus:border-[#00ff88]/50 transition-colors"
                          placeholder="john@example.com"
                        />
                      </div>

                      {/* Company */}
                      <div>
                        <label htmlFor="company" className="block text-sm font-medium text-white/80 mb-2">
                          Company Name
                        </label>
                        <input
                          type="text"
                          id="company"
                          name="company"
                          value={formData.company}
                          onChange={handleChange}
                          className="w-full px-4 py-3 bg-[#1a1a1a] border border-[#333] rounded-lg text-white placeholder:text-white/40 focus:outline-none focus:border-[#00ff88]/50 transition-colors"
                          placeholder="Your Company"
                        />
                      </div>

                      {/* Phone */}
                      <div>
                        <label htmlFor="phone" className="block text-sm font-medium text-white/80 mb-2">
                          Phone Number
                        </label>
                        <input
                          type="tel"
                          id="phone"
                          name="phone"
                          value={formData.phone}
                          onChange={handleChange}
                          className="w-full px-4 py-3 bg-[#1a1a1a] border border-[#333] rounded-lg text-white placeholder:text-white/40 focus:outline-none focus:border-[#00ff88]/50 transition-colors"
                          placeholder="+1 (555) 123-4567"
                        />
                      </div>
                    </div>

                    {/* Message */}
                    <div className="mb-6">
                      <label htmlFor="message" className="block text-sm font-medium text-white/80 mb-2">
                        Your Message *
                      </label>
                      <textarea
                        id="message"
                        name="message"
                        value={formData.message}
                        onChange={handleChange}
                        required
                        rows={6}
                        className="w-full px-4 py-3 bg-[#1a1a1a] border border-[#333] rounded-lg text-white placeholder:text-white/40 focus:outline-none focus:border-[#00ff88]/50 transition-colors resize-none"
                        placeholder="Tell us about your project or inquiry..."
                      />
                    </div>

                    {/* Submit Button */}
                    <Button
                      type="submit"
                      disabled={isSubmitting}
                      className="w-full bg-[#00ff88] text-[#0a0a0a] hover:bg-[#00ff88]/90 font-semibold py-4 text-lg transition-all hover:scale-[1.02] hover:shadow-[0_0_40px_rgba(0,255,136,0.5)] disabled:opacity-50 disabled:cursor-not-allowed group"
                    >
                      {isSubmitting ? (
                        <span className="flex items-center justify-center gap-2">
                          <svg className="animate-spin h-5 w-5" viewBox="0 0 24 24">
                            <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" fill="none" />
                            <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                          </svg>
                          Sending...
                        </span>
                      ) : (
                        <span className="flex items-center justify-center gap-2">
                          Send Message
                          <Send className="w-5 h-5 transition-transform group-hover:translate-x-1" />
                        </span>
                      )}
                    </Button>
                  </form>
                )}
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* Map Section */}
      <section className="py-20 bg-[#111] border-t border-[#222]">
        <div className="container mx-auto px-6">
          <div className="max-w-4xl mx-auto text-center">
            <h2 className="text-3xl font-bold text-white mb-4">Visit Our Office</h2>
            <p className="text-white/60 mb-8">
              Located in the heart of San Francisco&apos;s tech district
            </p>
            <div className="aspect-video rounded-2xl overflow-hidden glass">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d50470.95027952943!2d-122.47261895!3d37.7576171!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80859a6d00690021%3A0x4a501367f076adff!2sSan%20Francisco%2C%20CA!5e0!3m2!1sen!2sus!4v1650000000000!5m2!1sen!2sus"
                width="100%"
                height="100%"
                style={{ border: 0, filter: "invert(90%) hue-rotate(180deg)" }}
                allowFullScreen
                loading="lazy"
                referrerPolicy="no-referrer-when-downgrade"
              />
            </div>
          </div>
        </div>
      </section>

      <Footer />
    </main>
  )
}
