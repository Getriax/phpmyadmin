<?php
/**
 * PHPUnit
 *
 * Copyright (c) 2010-2013, Sebastian Bergmann <sebastian@phpunit.de>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Sebastian Bergmann nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    PHPUnit_Selenium
 * @author     Giorgio Sironi <info@giorgiosironi.com>
 * @copyright  2010-2013 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://www.phpunit.de/
 * @since      File available since Release 1.2.6
 */

/**
 * Adds a cookie.
 *
 * @package    PHPUnit_Selenium
 * @author     Giorgio Sironi <info@giorgiosironi.com>
 * @copyright  2010-2013 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @version    Release: @package_version@
 * @link       http://www.phpunit.de/
 * @since      Class available since Release 1.2.6
 */
class PHPUnit_Extensions_Selenium2TestCase_Session_Cookie_Builder
{
    private $name;
    private $value;
    private $path;
    private $domain;
    private $secure = FALSE;
    private $expiry;

    public function __construct($cookieFacade, $name, $value)
    {
        $this->cookieFacade = $cookieFacade;
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @param string
     * @return PHPUnit_Extensions_Selenium2TestCase_Session_Cookie_Builder
     */
    public function path($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param string
     * @return PHPUnit_Extensions_Selenium2TestCase_Session_Cookie_Builder
     */
    public function domain($domain)
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * @param boolean
     * @return PHPUnit_Extensions_Selenium2TestCase_Session_Cookie_Builder
     */
    public function secure($secure)
    {
        $this->secure = $secure;
        return $this;
    }

    /**
     * @param integer
     * @return PHPUnit_Extensions_Selenium2TestCase_Session_Cookie_Builder
     */
    public function expiry($expiry)
    {
        $this->expiry = $expiry;
        return $this;
    }

    /**
     * @return void
     */
    public function set()
    {
        $cookieData = array(
            'name' => $this->name,
            'value' => $this->value,
            'secure' => $this->secure,
        );
        foreach (array('path', 'domain', 'expiry') as $parameter) {
            if ($this->$parameter !== NULL) {
                $cookieData[$parameter] = $this->$parameter;
            }
        }
        $this->cookieFacade->postCookie($cookieData);
    }
}
