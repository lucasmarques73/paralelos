<%@ Page Title="" Language="C#" MasterPageFile="~/PaginaMestre.Master" AutoEventWireup="true" CodeBehind="cadastro.aspx.cs" Inherits="ExemploMasterPage.cadastro" %>
<asp:Content ID="Content1" ContentPlaceHolderID="head" runat="server">
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="ContentPlaceHolder1" runat="server">
    <h1>Página de Cadastro</h1>
    <asp:Label ID="Label1" runat="server" Text="Login"></asp:Label>
    <asp:TextBox ID="txtLogin" runat="server"></asp:TextBox>
    <asp:RequiredFieldValidator ID="RequiredFieldValidator1" runat="server" ErrorMessage="Campo Login Obrigatório" ControlToValidate="txtLogin" Font-Bold="True" ForeColor="Red"></asp:RequiredFieldValidator>
    <br />
    <asp:Label ID="Label2" runat="server" Text="Nome"></asp:Label>
    <asp:TextBox ID="txtNome" runat="server"></asp:TextBox>
    <asp:RequiredFieldValidator ID="RequiredFieldValidator2" runat="server" ErrorMessage="Digite um nome" ControlToValidate="txtNome" Font-Bold="True" ForeColor="Red"></asp:RequiredFieldValidator>
    <br />
    <asp:Label ID="Label3" runat="server" Text="E-mail"></asp:Label>
    <asp:TextBox ID="txtEmail" runat="server"></asp:TextBox>
    <asp:RequiredFieldValidator ID="RequiredFieldValidator4" runat="server" ErrorMessage="Digite um e-mail" ControlToValidate="txtEmail" Font-Bold="True" ForeColor="Red"></asp:RequiredFieldValidator>
    <asp:RegularExpressionValidator ID="RegularExpressionValidator1" runat="server" ErrorMessage="E-mail Inválido!" ControlToValidate="txtEmail" Font-Bold="True" ForeColor="Red" ValidationExpression="\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*"></asp:RegularExpressionValidator>
    <br />
    <asp:Label ID="Label6" runat="server" Text="Idade"></asp:Label>
    <asp:TextBox ID="txtIdade" runat="server"></asp:TextBox>
    <asp:RangeValidator ID="RangeValidator1" runat="server" ErrorMessage="Idade Inválida" ControlToValidate="txtIdade" Font-Bold="True" ForeColor="Red" MaximumValue="200" MinimumValue="0" Type="Integer"></asp:RangeValidator>
    <br />
    <asp:Label ID="Label4" runat="server" Text="Senha"></asp:Label>
    <asp:TextBox ID="txtSenha" runat="server"></asp:TextBox>
    <asp:RequiredFieldValidator ID="RequiredFieldValidator3" runat="server" ErrorMessage="Digite a senha" ControlToValidate="txtSenha" Font-Bold="True" ForeColor="Red"></asp:RequiredFieldValidator>
    <br />
    <asp:Label ID="Label5" runat="server" Text="Confirma Senha"></asp:Label>
    <asp:TextBox ID="txtConfirmaSenha" runat="server"></asp:TextBox>
    <asp:CompareValidator ID="CompareValidator1" runat="server" ErrorMessage="Senhas diferentes" ControlToCompare="txtSenha" ControlToValidate="txtConfirmaSenha" Font-Bold="True" ForeColor="Red"></asp:CompareValidator>


    <br />
    <asp:ImageButton ID="btnCadastrar" runat="server" ImageUrl="~/imagens/disk_blue_ok.png" OnClick="btnCadastrar_Click" />
    <br />
    <asp:Label ID="LabelMensagem" runat="server" Text="..."></asp:Label>
    <br />
    <asp:ValidationSummary ID="ValidationSummary1" runat="server" Font-Bold="True" ForeColor="Red" />

    <br />
</asp:Content>
